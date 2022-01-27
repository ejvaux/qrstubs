<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Email extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('is_active', function (Builder $builder) {
            $builder->where('active', '=', 1);
        });
    }
    public function scopeTo($query)
    {
        return $query->where('type', '=', 'to');
    }
    public function scopeCc($query)
    {
        return $query->where('type', '=', 'cc');
    }
    public function email_group()
    {
        return $this->belongsto('App\EmailGroup');
    }
}
