<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarModel;


class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
    {
        $models = [
            ['name' => 'BMW'],
            ['name' => 'Mercedes'],
            ['name' => 'Audi'],
            ['name' => 'Renault'],
            ['name' => 'Toyota'],
            ['name' => 'Golf'],
        ];
    
        foreach ($models as $model) {
            CarModel::create($model);
        }
    }}