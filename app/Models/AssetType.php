<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    //
    public static function getImagesType () {
    	return 1;
    }

    public static function getSoundType () {
    	return 2;
    }
}
