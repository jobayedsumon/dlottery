<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Ticket extends Model
{
    use Searchable;
    protected $cast = ['ticket_number'=>'object'];

    protected $guarded = ['id'];

    public function lottery()
    {
    	return $this->belongsTo(Lottery::class);
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id','id');
    }

    public function winners()
    {
    	return $this->hasMany(Winner::class);
    }

    public function badgeStatusData()
    {
        $html = '';
        if($this->status == Status::PUBLISHED){
            $html = '<span class="badge badge--success">'.trans("PUBLISHED").'</span>';
        }
        elseif($this->status == Status::UNPUBLISHED){
            $html = '<span class="badge badge--warning">'.trans("WILL PUBLISHED").'</span>';
        }
        return $html;
    }
    public function statusBadge(): Attribute
    {
        return new Attribute(
            get:fn () => $this->badgeStatusData(),
        );
    }


}
