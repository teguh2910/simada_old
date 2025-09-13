<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(DocumentTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(PicSeeder::class);
    }
}
