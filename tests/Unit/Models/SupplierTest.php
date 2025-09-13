<?php

namespace Tests\Unit\Models;

use App\Supplier;
use App\Rfq;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SupplierTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $supplier = new Supplier([
            'name' => 'ABC Suppliers Ltd.',
            'pic' => 'John Smith',
            'no_hp' => '+1234567890',
            'email' => 'john@abcsuppliers.com',
            'presdir' => 'Jane Doe',
            'alamat' => '123 Supplier Street',
            'no_telp' => '+0987654321',
            'is_active' => true
        ]);

        $this->assertEquals('ABC Suppliers Ltd.', $supplier->name);
        $this->assertEquals('John Smith', $supplier->pic);
        $this->assertEquals('+1234567890', $supplier->no_hp);
        $this->assertEquals('john@abcsuppliers.com', $supplier->email);
        $this->assertTrue($supplier->is_active);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $supplier = new Supplier();
        $fillable = $supplier->getFillable();

        $expected = ['name', 'pic', 'no_hp', 'email', 'presdir', 'alamat', 'no_telp', 'is_active'];
        
        foreach ($expected as $attribute) {
            $this->assertContains($attribute, $fillable);
        }
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $supplier = new Supplier();
        $casts = $supplier->getCasts();

        $this->assertEquals('boolean', $casts['is_active']);
    }

    /** @test */
    public function it_has_many_rfqs()
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            (new Supplier())->rfqs()
        );
    }

    /** @test */
    public function it_can_scope_active_suppliers()
    {
        $supplier = new Supplier();
        $query = $supplier->newQuery();
        
        $scopedQuery = $supplier->scopeActive($query);
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $scopedQuery);
    }

    /** @test */
    public function it_can_save_supplier_to_database()
    {
        $supplier = Supplier::create([
            'name' => 'Test Supplier Co.',
            'pic' => 'Alice Johnson',
            'no_hp' => '+1111111111',
            'email' => 'alice@testsupplier.com',
            'presdir' => 'Bob Wilson',
            'alamat' => '456 Test Avenue',
            'no_telp' => '+2222222222',
            'is_active' => true
        ]);

        // Verify in database using direct query
        $savedSupplier = Supplier::where('name', 'Test Supplier Co.')
                                 ->where('pic', 'Alice Johnson')
                                 ->where('email', 'alice@testsupplier.com')
                                 ->first();
        
        $this->assertInstanceOf(Supplier::class, $savedSupplier);
        $this->assertEquals('Test Supplier Co.', $savedSupplier->name);
        $this->assertEquals('Alice Johnson', $savedSupplier->pic);
        $this->assertEquals('alice@testsupplier.com', $savedSupplier->email);

        $this->assertInstanceOf(Supplier::class, $supplier);
        $this->assertEquals('Test Supplier Co.', $supplier->name);
    }

    /** @test */
    public function it_can_be_created_with_minimal_data()
    {
        $supplier = Supplier::create([
            'name' => 'Minimal Supplier'
        ]);

        // Verify in database using direct query
        $savedSupplier = Supplier::where('name', 'Minimal Supplier')->first();
        
        $this->assertInstanceOf(Supplier::class, $savedSupplier);
        $this->assertEquals('Minimal Supplier', $savedSupplier->name);

        $this->assertEquals('Minimal Supplier', $supplier->name);
    }

    /** @test */
    public function active_scope_handles_missing_column_gracefully()
    {
        $supplier = new Supplier();
        $query = $supplier->newQuery();
        
        // This should not throw an exception even if is_active column doesn't exist
        $result = $supplier->scopeActive($query);
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $result);
    }

    /** @test */
    public function it_can_store_contact_information()
    {
        $supplier = Supplier::create([
            'name' => 'Contact Test Supplier',
            'pic' => 'Contact Person',
            'no_hp' => '+6281234567890',
            'email' => 'contact@supplier.com',
            'presdir' => 'President Director',
            'alamat' => 'Jl. Supplier No. 123, Jakarta',
            'no_telp' => '+622123456789',
            'is_active' => true
        ]);

        $this->assertEquals('+6281234567890', $supplier->no_hp);
        $this->assertEquals('+622123456789', $supplier->no_telp);
        $this->assertEquals('Jl. Supplier No. 123, Jakarta', $supplier->alamat);
        $this->assertEquals('President Director', $supplier->presdir);
    }
}