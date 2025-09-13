<?php

namespace Tests\Feature\Controllers;

use TestCase;
use App\User;
use App\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomerControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'dept' => 'IT',
            'npk' => '12345'
        ]);
    }

    /** @test */
    public function it_displays_customers_index_page()
    {
        $this->actingAs($this->user);

        Customer::create(['name' => 'Test Customer 1', 'is_active' => true]);
        Customer::create(['name' => 'Test Customer 2', 'is_active' => false]);

        $response = $this->get(route('customers.index'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_create_customer_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('customers.create'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_store_a_new_customer()
    {
        $this->actingAs($this->user);

        $customerData = [
            'name' => 'New Customer Inc.',
            'is_active' => true
        ];

        $response = $this->post(route('customers.store'), $customerData);

        // Check if customer was saved to database
        $customer = \DB::table('customers')->where('name', 'New Customer Inc.')->first();
        $this->assertNotNull($customer);
        $this->assertEquals(true, (bool)$customer->is_active);

        $this->assertRedirectedTo(route('customers.index'));
    }

    /** @test */
    public function it_validates_required_name_when_storing_customer()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('customers.store'), [
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_validates_unique_name_when_storing_customer()
    {
        $this->actingAs($this->user);

        Customer::create(['name' => 'Existing Customer', 'is_active' => true]);

        $response = $this->post(route('customers.store'), [
            'name' => 'Existing Customer',
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_displays_customer_details()
    {
        $this->actingAs($this->user);

        $customer = Customer::create([
            'name' => 'Display Customer',
            'is_active' => true
        ]);

        $response = $this->get(route('customers.show', $customer->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_edit_customer_form()
    {
        $this->actingAs($this->user);

        $customer = Customer::create([
            'name' => 'Edit Customer',
            'is_active' => true
        ]);

        $response = $this->get(route('customers.edit', $customer->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_update_customer()
    {
        $this->actingAs($this->user);

        $customer = Customer::create([
            'name' => 'Original Customer',
            'is_active' => true
        ]);

        $updateData = [
            'name' => 'Updated Customer',
            'is_active' => false
        ];

        $response = $this->put(route('customers.update', $customer->id), $updateData);

        // Check if customer was updated in database
        $updatedCustomer = \DB::table('customers')->where('id', $customer->id)->first();
        $this->assertEquals('Updated Customer', $updatedCustomer->name);
        $this->assertEquals(false, (bool)$updatedCustomer->is_active);

        $this->assertRedirectedTo(route('customers.index'));
    }

    /** @test */
    public function it_validates_unique_name_when_updating_customer()
    {
        $this->actingAs($this->user);

        $customer1 = Customer::create(['name' => 'Customer 1', 'is_active' => true]);
        $customer2 = Customer::create(['name' => 'Customer 2', 'is_active' => true]);

        $response = $this->put(route('customers.update', $customer2->id), [
            'name' => 'Customer 1', // This name already exists
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('name');
        
        // Customer 2 should remain unchanged
        $updatedCustomer = \DB::table('customers')->where('id', $customer2->id)->first();
        $this->assertEquals('Customer 2', $updatedCustomer->name);
    }

    /** @test */
    public function it_can_delete_customer()
    {
        $this->actingAs($this->user);

        $customer = Customer::create([
            'name' => 'Delete Customer',
            'is_active' => true
        ]);

        $response = $this->delete(route('customers.destroy', $customer->id));

        // Check if customer was deleted from database
        $deletedCustomer = \DB::table('customers')->where('id', $customer->id)->first();
        $this->assertNull($deletedCustomer);

        $this->assertRedirectedTo(route('customers.index'));
    }

    /** @test */
    public function it_returns_404_for_non_existent_customer()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('customers.show', 99999));

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_paginates_customers_on_index_page()
    {
        $this->actingAs($this->user);

        // Create more than 10 customers to test pagination
        for ($i = 1; $i <= 15; $i++) {
            Customer::create([
                'name' => "Customer {$i}",
                'is_active' => true
            ]);
        }

        $response = $this->get(route('customers.index'));

        $this->assertResponseOk();
    }
}
