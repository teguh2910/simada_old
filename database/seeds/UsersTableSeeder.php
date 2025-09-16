<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update the first user to be a manager for testing purposes
        $user = \App\User::first();
        if ($user) {
            $user->update(['jabatan' => 'manager']);
        }

        // You can also create a dedicated manager user
        /*
        \App\User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
            'jabatan' => 'manager',
            'dept' => 'Management',
            'npk' => 'MGR001',
        ]);
        */
    }
}
