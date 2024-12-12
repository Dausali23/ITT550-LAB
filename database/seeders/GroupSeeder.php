<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_seed = [
            ['id'=>'1','name'=>'CS251','part'=>'1'],
            ['id'=>'2','name'=>'CS110','part'=>'1'],
            ['id'=>'3','name'=>'CS255','part'=>'1'],
            ['id'=>'4','name'=>'AT110','part'=>'1'],
            ['id'=>'5','name'=>'AT120','part'=>'1'],
            ];
        
        foreach ($group_seed as $group_seed)
        {
            Group::firstOrCreate($group_seed);
        }
    }
}
