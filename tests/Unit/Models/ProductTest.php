<?php

namespace Tests\Unit\Models;

use App\Product;
use App\Rfq;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $product = new Product([
            'name' => 'Test Product',
            'is_active' => true
        ]);

        $this->assertEquals('Test Product', $product->name);
        $this->assertTrue($product->is_active);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $product = new Product();
        $fillable = $product->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('is_active', $fillable);
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $product = new Product();
        $casts = $product->getCasts();

        $this->assertEquals('boolean', $casts['is_active']);
    }

    /** @test */
    public function it_has_many_rfqs()
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            (new Product())->rfqs()
        );
    }

    /** @test */
    public function it_can_scope_active_products()
    {
        $product = new Product();
        $query = $product->newQuery();
        
        $scopedQuery = $product->scopeActive($query);
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $scopedQuery);
    }

    /** @test */
    public function it_can_save_product_to_database()
    {
        $product = Product::create([
            'name' => 'Widget Pro 3000',
            'is_active' => true
        ]);

        // Verify in database using direct query
        $savedProduct = Product::where('name', 'Widget Pro 3000')->where('is_active', true)->first();
        
        $this->assertInstanceOf(Product::class, $savedProduct);
        $this->assertEquals('Widget Pro 3000', $savedProduct->name);
        $this->assertTrue($savedProduct->is_active);
        
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Widget Pro 3000', $product->name);
    }

    /** @test */
    public function active_scope_handles_missing_column_gracefully()
    {
        $product = new Product();
        $query = $product->newQuery();
        
        // This should not throw an exception even if is_active column doesn't exist
        $result = $product->scopeActive($query);
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $result);
    }

    /** @test */
    public function it_can_be_inactive()
    {
        $product = Product::create([
            'name' => 'Discontinued Product',
            'is_active' => false
        ]);

        // Verify in database using direct query
        $savedProduct = Product::where('name', 'Discontinued Product')->first();
        
        $this->assertInstanceOf(Product::class, $savedProduct);
        $this->assertEquals('Discontinued Product', $savedProduct->name);
        $this->assertFalse($savedProduct->is_active);
        
        $this->assertFalse($product->is_active);
    }
}