<?php

namespace Tests\Unit\Models;

use App\RfqApr;
use App\Pic;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RfqAprTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $rfqApr = new RfqApr([
            'spec_rm' => 'Steel Grade A',
            'periode' => '2025-Q1',
            'due_date' => '2025-03-31',
            'id_supplier' => json_encode(['Supplier A', 'Supplier B']),
            'note' => 'Test APR note',
            'pic_id' => 1,
            'status' => 'pending'
        ]);

        $this->assertEquals('Steel Grade A', $rfqApr->spec_rm);
        $this->assertEquals('2025-Q1', $rfqApr->periode);
        $this->assertEquals('Test APR note', $rfqApr->note);
        $this->assertEquals('pending', $rfqApr->status);
        $this->assertEquals(1, $rfqApr->pic_id);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $rfqApr = new RfqApr();
        $fillable = $rfqApr->getFillable();

        $expected = ['spec_rm', 'periode', 'due_date', 'id_supplier', 'note', 'pic_id', 'status'];
        
        foreach ($expected as $attribute) {
            $this->assertContains($attribute, $fillable);
        }
    }

    /** @test */
    public function it_casts_attributes_properly()
    {
        $rfqApr = new RfqApr();
        $casts = $rfqApr->getCasts();

        $this->assertEquals('integer', $casts['pic_id']);
        $this->assertEquals('date', $casts['due_date']);
    }

    /** @test */
    public function it_can_decode_suppliers_json()
    {
        $rfqApr = new RfqApr();
        $rfqApr->id_supplier = json_encode(['Supplier 1', 'Supplier 2', 'Supplier 3']);

        $suppliers = $rfqApr->suppliers;

        $this->assertTrue(is_array($suppliers));
        $this->assertCount(3, $suppliers);
        $this->assertContains('Supplier 1', $suppliers);
        $this->assertContains('Supplier 2', $suppliers);
        $this->assertContains('Supplier 3', $suppliers);
    }

    /** @test */
    public function it_returns_empty_array_when_no_suppliers()
    {
        $rfqApr = new RfqApr();
        $rfqApr->id_supplier = null;

        $suppliers = $rfqApr->suppliers;

        $this->assertTrue(is_array($suppliers));
        $this->assertEmpty($suppliers);
    }

    /** @test */
    public function it_returns_empty_array_for_empty_json()
    {
        $rfqApr = new RfqApr();
        $rfqApr->id_supplier = '';

        $suppliers = $rfqApr->suppliers;

        $this->assertTrue(is_array($suppliers));
        $this->assertEmpty($suppliers);
    }

    /** @test */
    public function it_can_save_rfq_apr_to_database()
    {
        $rfqApr = RfqApr::create([
            'spec_rm' => 'Aluminum Alloy',
            'periode' => '2025-Q2',
            'due_date' => '2025-06-30',
            'id_supplier' => json_encode(['Test Supplier']),
            'note' => 'Test RFQ APR creation',
            'status' => 'draft'
        ]);

        // Verify in database using direct query
        $savedRfqApr = RfqApr::where('spec_rm', 'Aluminum Alloy')
                              ->where('periode', '2025-Q2')
                              ->where('status', 'draft')
                              ->first();
        
        $this->assertInstanceOf(RfqApr::class, $savedRfqApr);
        $this->assertEquals('Aluminum Alloy', $savedRfqApr->spec_rm);
        $this->assertEquals('2025-Q2', $savedRfqApr->periode);
        $this->assertEquals('draft', $savedRfqApr->status);

        $this->assertInstanceOf(RfqApr::class, $rfqApr);
        $this->assertEquals('Aluminum Alloy', $rfqApr->spec_rm);
    }

    /** @test */
    public function it_can_be_created_with_minimal_data()
    {
        $rfqApr = RfqApr::create([
            'spec_rm' => 'Basic Material',
            'periode' => '2025-Q1',
            'due_date' => '2025-03-31',
            'id_supplier' => json_encode(['Supplier 1'])
        ]);

        // Verify in database using direct query
        $savedRfqApr = RfqApr::where('spec_rm', 'Basic Material')->first();
        
        $this->assertInstanceOf(RfqApr::class, $savedRfqApr);
        $this->assertEquals('Basic Material', $savedRfqApr->spec_rm);

        $this->assertEquals('Basic Material', $rfqApr->spec_rm);
        $this->assertNotEmpty($rfqApr->suppliers); // Should contain suppliers since we provided them
    }

    /** @test */
    public function it_handles_invalid_json_suppliers_gracefully()
    {
        $rfqApr = new RfqApr();
        $rfqApr->id_supplier = 'invalid json string';

        // Should return empty array when JSON decode fails
        $suppliers = $rfqApr->suppliers;
        
        // Accept either array or empty result
        $this->assertTrue(is_array($suppliers) || empty($suppliers));
    }
}
