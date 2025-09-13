<?php

namespace Tests\Unit\Models;

use App\Rfq;
use App\Pic;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RfqTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $rfq = new Rfq([
            'customer' => 'ABC Company',
            'produk' => 'Product A',
            'std_qty' => 1000,
            'part_number' => 'PN001',
            'part_name' => 'Test Part',
            'qty_month' => 500,
            'note' => 'Test note'
        ]);

        $this->assertEquals('ABC Company', $rfq->customer);
        $this->assertEquals('Product A', $rfq->produk);
        $this->assertEquals(1000, $rfq->std_qty);
        $this->assertEquals('PN001', $rfq->part_number);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $rfq = new Rfq();
        $fillable = $rfq->getFillable();

        $expected = [
            'customer', 'produk', 'std_qty', 'drawing_time', 'OTS_Target',
            'OTOP_target', 'SOP', 'part_number', 'part_name', 'qty_month',
            'note', 'due_date', 'pic_id', 'id_supplier', 'drawing_file',
            'excel_term_file', 'loading_capacity_file'
        ];

        foreach ($expected as $attribute) {
            $this->assertContains($attribute, $fillable);
        }
    }

    /** @test */
    public function it_casts_dates_properly()
    {
        $rfq = new Rfq();
        $casts = $rfq->getCasts();

        $this->assertEquals('integer', $casts['pic_id']);
        $this->assertEquals('date', $casts['drawing_time']);
        $this->assertEquals('date', $casts['OTS_Target']);
        $this->assertEquals('date', $casts['OTOP_target']);
        $this->assertEquals('date', $casts['SOP']);
        $this->assertEquals('date', $casts['due_date']);
    }

    /** @test */
    public function it_can_decode_suppliers_json()
    {
        $rfq = new Rfq();
        $rfq->id_supplier = json_encode(['Supplier 1', 'Supplier 2']);

        $suppliers = $rfq->suppliers;

        $this->assertTrue(is_array($suppliers));
        $this->assertContains('Supplier 1', $suppliers);
        $this->assertContains('Supplier 2', $suppliers);
    }

    /** @test */
    public function it_returns_empty_array_when_no_suppliers()
    {
        $rfq = new Rfq();
        $rfq->id_supplier = null;

        $suppliers = $rfq->suppliers;

        $this->assertTrue(is_array($suppliers));
        $this->assertEmpty($suppliers);
    }

    /** @test */
    public function it_formats_suppliers_as_string()
    {
        $rfq = new Rfq();
        $rfq->id_supplier = json_encode(['Supplier A', 'Supplier B', 'Supplier C']);

        $formatted = $rfq->suppliers_formatted;

        $this->assertEquals('Supplier A, Supplier B, Supplier C', $formatted);
    }

    /** @test */
    public function it_belongs_to_pic()
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            (new Rfq())->pic()
        );
    }

    /** @test */
    public function it_returns_pic_name_when_pic_exists()
    {
        $pic = new Pic(['name' => 'John Doe']);
        $rfq = new Rfq();
        $rfq->setRelation('pic', $pic);

        $this->assertEquals('John Doe', $rfq->pic_name);
    }

    /** @test */
    public function it_returns_na_when_no_pic()
    {
        $rfq = new Rfq();
        $rfq->setRelation('pic', null);

        $this->assertEquals('N/A', $rfq->pic_name);
    }

    /** @test */
    public function it_returns_pic_info_when_pic_exists()
    {
        $pic = new Pic(['name' => 'John Doe', 'position' => 'Manager', 'department' => 'Engineering']);
        $rfq = new Rfq();
        $rfq->setRelation('pic', $pic);

        $this->assertEquals('John Doe (Manager) - Engineering', $rfq->pic_info);
    }

    /** @test */
    public function it_can_save_rfq_to_database()
    {
        // Create a PIC first for the RFQ relationship
        $pic = Pic::create([
            'name' => 'Test PIC',
            'position' => 'Manager'
        ]);

        $rfq = Rfq::create([
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'std_qty' => 100,
            'part_number' => 'TEST001',
            'part_name' => 'Test Part Name',
            'qty_month' => 50,
            'note' => 'Test note for RFQ',
            'due_date' => '2025-12-31',
            'pic_id' => $pic->id,
            'id_supplier' => json_encode(['Supplier 1', 'Supplier 2'])
        ]);

        // Verify in database using direct query
        $savedRfq = Rfq::where('customer', 'Test Customer')
                       ->where('produk', 'Test Product')
                       ->where('part_number', 'TEST001')
                       ->first();
        
        $this->assertInstanceOf(Rfq::class, $savedRfq);
        $this->assertEquals('Test Customer', $savedRfq->customer);
        $this->assertEquals('Test Product', $savedRfq->produk);
        $this->assertEquals('TEST001', $savedRfq->part_number);

        $this->assertInstanceOf(Rfq::class, $rfq);
    }
}
