<?php

use Illuminate\Database\Seeder;
use App\Pic;

class PicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pics = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@company.com',
                'phone' => '+62-812-3456-7890',
                'department' => 'Procurement',
                'position' => 'Senior Procurement Manager',
                'is_active' => true,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@company.com',
                'phone' => '+62-811-2345-6789',
                'department' => 'Engineering',
                'position' => 'Lead Engineer',
                'is_active' => true,
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob.johnson@company.com',
                'phone' => '+62-813-4567-8901',
                'department' => 'Quality',
                'position' => 'Quality Assurance Manager',
                'is_active' => true,
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice.brown@company.com',
                'phone' => '+62-814-5678-9012',
                'department' => 'Finance',
                'position' => 'Finance Manager',
                'is_active' => true,
            ],
            [
                'name' => 'Charlie Wilson',
                'email' => 'charlie.wilson@company.com',
                'phone' => '+62-815-6789-0123',
                'department' => 'Operations',
                'position' => 'Operations Director',
                'is_active' => true,
            ],
        ];

        foreach ($pics as $pic) {
            Pic::create($pic);
        }
    }
}
