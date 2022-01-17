<?php

namespace App;

use App\canteen;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('completed', function (Builder $builder) {
            $builder->where('status', '=', 2);
        });
    }
    public function canteen()
    {
        return $this->belongsto('App\canteen','canteen_id');
    }
    public function user()
    {
        return $this->belongsto('App\User','user_id');
    }
    public function scanner()
    {
        return $this->belongsto('App\User','scanner_id');
    }
    public function scopePending($query)
    {
        return $query->where('status', '=', 1);
    }
    public function scopeCancelled($query)
    {
        return $query->where('status', '=', 3);
    }
}
