<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'MIM',
            'npk' => '10460',
        ]);

        // Create additional users
        User::create([
            'name' => 'Esa',
            'email' => 'esa@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'NPL',
            'npk' => '10461',
        ]);

        User::create([
            'name' => 'Fernanda',
            'email' => 'fernanda@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'NPL',
            'npk' => '10462',
        ]);

        User::create([
            'name' => 'Nabila',
            'email' => 'nabila@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'NPL',
            'npk' => '10463',
        ]);

        User::create([
            'name' => 'Ardan',
            'email' => 'ardan@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'NPL',
            'npk' => '10464',
        ]);

        User::create([
            'name' => 'Friska',
            'email' => 'friska@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'NPL',
            'npk' => '10465',
        ]);

        User::create([
            'name' => 'Affandy',
            'email' => 'affandy@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'NPL',
            'npk' => '10466',
        ]);

        User::create([
            'name' => 'Seno',
            'email' => 'seno@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'QA',
            'npk' => '10467',
        ]);

        User::create([
            'name' => 'Junaedi',
            'email' => 'junaedi@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'OMD',
            'npk' => '10468',
        ]);

        User::create([
            'name' => 'Safitri',
            'email' => 'safitri@aisin-indonesia.co.id',
            'password' => Hash::make('password'),
            'dept' => 'ENG',
            'npk' => '10469',
        ]);

        // You can add more user records as needed
    }
}
