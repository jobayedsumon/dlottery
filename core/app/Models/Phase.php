<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Phase extends Model
{
    use GlobalStatus, Searchable;

    protected $guarded = ['id'];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }
    public function scopeActive($query)
    {
        $query->where('status', Status::ACTIVE);
    }
    public function scopeAvailable($query)
    {
        $query->active()
            ->where('draw_status', Status::RUNNING)
            ->where('start_date', '<=', now())
            ->where('draw_date', '>=', now())
            ->whereHas('lottery', function ($lottery) {
                $lottery->active()->whereHas('bonuses');
            });
    }
    public function scopeWaitingForManualDraw($query)
    {
        $query->where('draw_type', Status::MANUAL)
            ->where('draw_status', Status::RUNNING)
            ->where('status', Status::ENABLE)
            ->where('draw_date', '<', now());
    }


    public function badgeDraw()
    {
        $html = '';
        if ($this->draw_date < Carbon::now() && Status::MANUAL && $this->draw_status == Status::RUNNING) {
            $html = '<span class="badge badge--warning">' . trans("Waiting for Draw") . '</span>';
        } else {
            if ($this->draw_status == Status::COMPLETE) {
                $html = '<span class="badge badge--success">' . trans("Complete") . '</span>';
            } elseif ($this->draw_status == Status::RUNNING) {
                $html = '<span class="badge badge--primary">' . trans("Running") . '</span>';
            }
        }

        return $html;
    }

    public function DrawBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeDraw(),
        );
    }

    public function badgeDrawType()
    {
        $html = '';
        if ($this->draw_type == Status::AUTO) {
            $html = '<span class="badge badge--success">' . trans("Auto Draw") . '</span>';
        } elseif ($this->draw_type == Status::MANUAL) {
            $html = '<span class="badge badge--warning">' . trans("Manual Draw") . '</span>';
        }
        return $html;
    }
    public function DrawTypeBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeDrawType(),
        );
    }

    public function badgeStatusData()
    {
        $html = '';
        if ($this->status == Status::ACTIVE) {
            $html = '<span class="badge badge--success">' . trans("Active") . '</span>';
        } else {
            $html = '<span class="badge badge--danger">' . trans("Inactive") . '</span>';
        }
        return $html;
    }
    public function statusBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeStatusData(),
        );
    }
}
