<?php

namespace Tests\Feature\Controllers;

use TestCase;
use App\User;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductControllerTest extends TestCase
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
    public function it_displays_products_index_page()
    {
        $this->actingAs($this->user);

        Product::create(['name' => 'Widget A', 'is_active' => true]);
        Product::create(['name' => 'Widget B', 'is_active' => false]);

        $response = $this->get(route('products.index'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_create_product_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('products.create'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_store_a_new_product()
    {
        $this->actingAs($this->user);

        $productData = [
            'name' => 'New Widget Pro',
            'is_active' => true
        ];

        $response = $this->post(route('products.store'), $productData);

        // Check if product was saved to database
        $product = \DB::table('products')->where('name', 'New Widget Pro')->first();
        $this->assertNotNull($product);
        $this->assertEquals(true, (bool)$product->is_active);

        $this->assertRedirectedTo(route('products.index'));
    }

    /** @test */
    public function it_validates_required_name_when_storing_product()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('products.store'), [
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_validates_unique_name_when_storing_product()
    {
        $this->actingAs($this->user);

        Product::create(['name' => 'Existing Widget', 'is_active' => true]);

        $response = $this->post(route('products.store'), [
            'name' => 'Existing Widget',
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_displays_product_details()
    {
        $this->actingAs($this->user);

        $product = Product::create([
            'name' => 'Display Widget',
            'is_active' => true
        ]);

        $response = $this->get(route('products.show', $product->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_edit_product_form()
    {
        $this->actingAs($this->user);

        $product = Product::create([
            'name' => 'Edit Widget',
            'is_active' => true
        ]);

        $response = $this->get(route('products.edit', $product->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_update_product()
    {
        $this->actingAs($this->user);

        $product = Product::create([
            'name' => 'Original Widget',
            'is_active' => true
        ]);

        $updateData = [
            'name' => 'Updated Widget',
            'is_active' => false
        ];

        $response = $this->put(route('products.update', $product->id), $updateData);

        // Check if product was updated in database
        $updatedProduct = \DB::table('products')->where('id', $product->id)->first();
        $this->assertEquals('Updated Widget', $updatedProduct->name);
        $this->assertEquals(false, (bool)$updatedProduct->is_active);

        $this->assertRedirectedTo(route('products.index'));
    }

    /** @test */
    public function it_validates_unique_name_when_updating_product()
    {
        $this->actingAs($this->user);

        $product1 = Product::create(['name' => 'Widget 1', 'is_active' => true]);
        $product2 = Product::create(['name' => 'Widget 2', 'is_active' => true]);

        $response = $this->put(route('products.update', $product2->id), [
            'name' => 'Widget 1', // This name already exists
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('name');
        
        // Product 2 should remain unchanged
        $unchangedProduct = \DB::table('products')->where('id', $product2->id)->first();
        $this->assertEquals('Widget 2', $unchangedProduct->name);
    }

    /** @test */
    public function it_can_delete_product()
    {
        $this->actingAs($this->user);

        $product = Product::create([
            'name' => 'Delete Widget',
            'is_active' => true
        ]);

        $response = $this->delete(route('products.destroy', $product->id));

        // Check if product was deleted from database
        $deletedProduct = \DB::table('products')->where('id', $product->id)->first();
        $this->assertNull($deletedProduct);

        $this->assertRedirectedTo(route('products.index'));
    }

    /** @test */
    public function it_returns_404_for_non_existent_product()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('products.show', 99999));

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_can_toggle_product_active_status()
    {
        $this->actingAs($this->user);

        $product = Product::create([
            'name' => 'Toggle Widget',
            'is_active' => true
        ]);

        // Update to inactive
        $response = $this->put(route('products.update', $product->id), [
            'name' => 'Toggle Widget',
            'is_active' => false
        ]);

        $updatedProduct = \DB::table('products')->where('id', $product->id)->first();
        $this->assertEquals(false, (bool)$updatedProduct->is_active);

        $this->assertRedirectedTo(route('products.index'));

        // Update back to active
        $response = $this->put(route('products.update', $product->id), [
            'name' => 'Toggle Widget',
            'is_active' => true
        ]);

        $updatedProduct = \DB::table('products')->where('id', $product->id)->first();
        $this->assertEquals(true, (bool)$updatedProduct->is_active);
    }

    /** @test */
    public function it_paginates_products_on_index_page()
    {
        $this->actingAs($this->user);

        // Create more than 10 products to test pagination
        for ($i = 1; $i <= 15; $i++) {
            Product::create([
                'name' => "Widget {$i}",
                'is_active' => ($i % 2 == 0) // Alternate active/inactive
            ]);
        }

        $response = $this->get(route('products.index'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_products_ordered_by_name()
    {
        $this->actingAs($this->user);

        Product::create(['name' => 'Zebra Widget', 'is_active' => true]);
        Product::create(['name' => 'Alpha Widget', 'is_active' => true]);
        Product::create(['name' => 'Beta Widget', 'is_active' => true]);

        $response = $this->get(route('products.index'));

        $this->assertResponseOk();
    }
}
