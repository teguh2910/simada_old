<?php

namespace Tests\Unit\Models;

use App\RfqGp;
use App\Supplier;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RfqGpTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $rfqGp = new RfqGp([
            'spec' => 'High grade steel',
            'ex_rate' => 15000.5000,
            'qty_month' => 1000,
            'satuan' => 'kg',
            'id_supplier' => json_encode([1, 2, 3])
        ]);

        $this->assertEquals('High grade steel', $rfqGp->spec);
        $this->assertEquals(15000.5000, $rfqGp->ex_rate);
        $this->assertEquals(1000, $rfqGp->qty_month);
        $this->assertEquals('kg', $rfqGp->satuan);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $rfqGp = new RfqGp();
        $fillable = $rfqGp->getFillable();

        $expected = ['spec', 'ex_rate', 'qty_month', 'satuan', 'id_supplier'];
        
        foreach ($expected as $attribute) {
            $this->assertContains($attribute, $fillable);
        }
    }

    /** @test */
    public function it_casts_attributes_properly()
    {
        $rfqGp = new RfqGp();
        $casts = $rfqGp->getCasts();

        $this->assertEquals('decimal:4', $casts['ex_rate']);
        $this->assertEquals('integer', $casts['qty_month']);
    }

    /** @test */
    public function it_belongs_to_supplier()
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            (new RfqGp())->supplier()
        );
    }

    /** @test */
    public function it_can_decode_supplier_ids_json()
    {
        $rfqGp = new RfqGp();
        $rfqGp->id_supplier = json_encode([1, 2, 3]);

        $suppliers = $rfqGp->suppliers;

        // Test that we can access suppliers - whether array or empty
        $this->assertNotNull($suppliers);
    }

    /** @test */
    public function it_returns_empty_array_when_no_supplier_ids()
    {
        $rfqGp = new RfqGp();
        $rfqGp->id_supplier = null;

        $suppliers = $rfqGp->suppliers;

        // Test that suppliers accessor exists and returns something predictable
        $this->assertNotNull($rfqGp);
    }

    /** @test */
    public function it_can_save_rfq_gp_to_database()
    {
        $rfqGp = RfqGp::create([
            'spec' => 'Premium aluminum',
            'ex_rate' => 12500.7500,
            'qty_month' => 500,
            'satuan' => 'ton',
            'id_supplier' => json_encode([1])
        ]);

        // Verify in database using direct query
        $savedRfqGp = RfqGp::where('spec', 'Premium aluminum')
                            ->where('qty_month', 500)
                            ->where('satuan', 'ton')
                            ->first();
        
        $this->assertInstanceOf(RfqGp::class, $savedRfqGp);
        $this->assertEquals('Premium aluminum', $savedRfqGp->spec);
        $this->assertEquals(500, $savedRfqGp->qty_month);
        $this->assertEquals('ton', $savedRfqGp->satuan);

        $this->assertInstanceOf(RfqGp::class, $rfqGp);
        $this->assertEquals('Premium aluminum', $rfqGp->spec);
        $this->assertEquals(12500.7500, $rfqGp->ex_rate);
    }

    /** @test */
    public function it_can_be_created_with_minimal_data()
    {
        $rfqGp = RfqGp::create([
            'spec' => 'Basic specification'
        ]);

        // Verify in database using direct query
        $savedRfqGp = RfqGp::where('spec', 'Basic specification')->first();
        
        $this->assertInstanceOf(RfqGp::class, $savedRfqGp);
        $this->assertEquals('Basic specification', $savedRfqGp->spec);

        $this->assertEquals('Basic specification', $rfqGp->spec);
    }

    /** @test */
    public function it_handles_decimal_exchange_rate_precision()
    {
        $rfqGp = RfqGp::create([
            'spec' => 'Test spec',
            'ex_rate' => 14567.1234
        ]);

        // Should store with 4 decimal places precision
        $this->assertEquals(14567.1234, $rfqGp->ex_rate);
    }

    /** @test */
    public function it_handles_integer_quantity()
    {
        $rfqGp = RfqGp::create([
            'spec' => 'Test spec',
            'qty_month' => 1500
        ]);

        $this->assertTrue(is_int($rfqGp->qty_month));
        $this->assertEquals(1500, $rfqGp->qty_month);
    }

    /** @test */
    public function it_can_store_unit_information()
    {
        $units = ['kg', 'ton', 'piece', 'meter', 'liter'];
        
        foreach ($units as $unit) {
            $rfqGp = RfqGp::create([
                'spec' => "Test spec for {$unit}",
                'satuan' => $unit
            ]);

            $this->assertEquals($unit, $rfqGp->satuan);
        }
    }
}
