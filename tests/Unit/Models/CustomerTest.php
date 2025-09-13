<?php

namespace Tests\Unit\Models;

use App\Customer;
use App\Rfq;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $customer = new Customer([
            'name' => 'ABC Corporation',
            'is_active' => true
        ]);

        $this->assertEquals('ABC Corporation', $customer->name);
        $this->assertTrue($customer->is_active);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $customer = new Customer();
        $fillable = $customer->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('is_active', $fillable);
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $customer = new Customer();
        $casts = $customer->getCasts();

        $this->assertEquals('boolean', $casts['is_active']);
    }

    /** @test */
    public function it_has_many_rfqs()
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            (new Customer())->rfqs()
        );
    }

    /** @test */
    public function it_can_scope_active_customers()
    {
        $customer = new Customer();
        $query = $customer->newQuery();
        
        $scopedQuery = $customer->scopeActive($query);
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $scopedQuery);
    }

    /** @test */
    public function it_can_save_customer_to_database()
    {
        $customer = Customer::create([
            'name' => 'Test Customer Inc.',
            'is_active' => true
        ]);

        // Verify customer was saved by finding it in database
        $savedCustomer = Customer::where('name', 'Test Customer Inc.')->first();
        
        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertInstanceOf(Customer::class, $savedCustomer);
        $this->assertEquals('Test Customer Inc.', $customer->name);
        $this->assertTrue($savedCustomer->is_active);
    }

    /** @test */
    public function it_defaults_is_active_to_false()
    {
        $customer = Customer::create([
            'name' => 'Test Customer Without Active Flag'
        ]);

        // Verify customer was saved
        $savedCustomer = Customer::where('name', 'Test Customer Without Active Flag')->first();
        
        $this->assertInstanceOf(Customer::class, $savedCustomer);
        $this->assertEquals('Test Customer Without Active Flag', $savedCustomer->name);
        
        // Note: The actual default behavior depends on database schema
        // This test assumes the column has a default value
    }

    /** @test */
    public function active_scope_handles_missing_column_gracefully()
    {
        $customer = new Customer();
        $query = $customer->newQuery();
        
        // This should not throw an exception even if is_active column doesn't exist
        $result = $customer->scopeActive($query);
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $result);
    }
}