<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'login_log';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */

    public $timestamps = false;
}
