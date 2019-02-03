<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_info';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => false,
    ];
}
