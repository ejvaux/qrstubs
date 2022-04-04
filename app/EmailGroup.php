<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_groups';

    public function emails()
    {
        return $this->hasMany('App\Email');
    }
}
