<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arr = array(1, 2, 3, 4);
        foreach ($arr as &$value) {
            DB::table('posts')->insert([
                'title' => 'Lorem ipsum title number ' . $value,
                'content' => 'Lorem ipsum content number ' . $value,
            ]);
        }
    }
}
