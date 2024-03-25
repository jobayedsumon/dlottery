<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Lottery extends Model
{
    use GlobalStatus, Searchable;
    protected $guarded = ['id'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function phase()
    {
        return $this->hasMany(Phase::class);
    }

    public function bonuses()
    {
        return $this->hasMany(WinBonus::class);
    }
    public function scopeActive($query)
    {
        $query->where('status', Status::ACTIVE);
    }
    public function badgeData()
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
            get: fn () => $this->badgeData(),
        );
    }
}
