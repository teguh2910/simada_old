<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            'PT. Steel & Metal Corp',
            'CV. Precision Casting',
            'PT. Auto Parts Indonesia',
            'PT. Metal Fabrication Ltd',
            'CV. Engineering Solutions',
            'PT. Industrial Components',
            'PT. Manufacturing Excellence'
        ];

        foreach ($suppliers as $supplierName) {
            Supplier::firstOrCreate(
                ['name' => $supplierName],
                ['is_active' => true]
            );
        }
    }
}
