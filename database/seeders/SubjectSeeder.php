<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_seed = [
            ['id'=>'1','subject_code'=>'CS251','subject_name'=>'1','lecturer_name'=>''],
            ['id'=>'2','subject_code'=>'CS110','subject_name'=>'1','lecturer_name'=>''],
            ['id'=>'3','subject_code'=>'CS255','subject_name'=>'1','lecturer_name'=>''],
            ['id'=>'4','subject_code'=>'AT110','subject_name'=>'1','lecturer_name'=>''],
            ['id'=>'5','subject_code'=>'AT120','subject_name'=>'1','lecturer_name'=>''],
            ];
            
        foreach ($subject_seed as $subject_seed)
        {
            Subject::firstOrCreate($subject_seed);
        }
    }
}
