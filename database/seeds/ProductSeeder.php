<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Engine Block',
                'code' => 'EB001',
                'description' => 'High-performance engine block for automotive applications',
                'category' => 'Engine Components',
                'is_active' => true
            ],
            [
                'name' => 'Transmission Case',
                'code' => 'TC002',
                'description' => 'Durable transmission case with precision machining',
                'category' => 'Transmission Components',
                'is_active' => true
            ],
            [
                'name' => 'Brake Caliper',
                'code' => 'BC003',
                'description' => 'High-quality brake caliper for vehicle safety systems',
                'category' => 'Brake Components',
                'is_active' => true
            ],
            [
                'name' => 'Cylinder Head',
                'code' => 'CH004',
                'description' => 'Precision-engineered cylinder head for optimal performance',
                'category' => 'Engine Components',
                'is_active' => true
            ],
            [
                'name' => 'Gear Housing',
                'code' => 'GH005',
                'description' => 'Robust gear housing for heavy-duty applications',
                'category' => 'Transmission Components',
                'is_active' => true
            ],
            [
                'name' => 'Oil Pan',
                'code' => 'OP006',
                'description' => 'Oil pan with integrated cooling fins',
                'category' => 'Engine Components',
                'is_active' => true
            ],
            [
                'name' => 'Intake Manifold',
                'code' => 'IM007',
                'description' => 'Optimized intake manifold for better air flow',
                'category' => 'Engine Components',
                'is_active' => true
            ],
            [
                'name' => 'Exhaust Manifold',
                'code' => 'EM008',
                'description' => 'High-temperature resistant exhaust manifold',
                'category' => 'Exhaust Components',
                'is_active' => true
            ],
            [
                'name' => 'Turbocharger Housing',
                'code' => 'TH009',
                'description' => 'Turbocharger housing for performance enhancement',
                'category' => 'Turbo Components',
                'is_active' => true
            ],
            [
                'name' => 'Flywheel',
                'code' => 'FW010',
                'description' => 'Precision balanced flywheel for smooth operation',
                'category' => 'Engine Components',
                'is_active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
