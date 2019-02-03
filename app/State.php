<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'state';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => false,
    ];
}
