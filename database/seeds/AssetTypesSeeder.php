<?php

use Illuminate\Database\Seeder;

use App\Models\AssetType;

class AssetTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AssetType::create(['name' => 'imagen']);
        AssetType::create(['name' => 'sonido']);
    }
}
