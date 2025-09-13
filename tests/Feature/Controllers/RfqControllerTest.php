<?php

namespace Tests\Feature\Controllers;

use TestCase;
use App\User;
use App\Rfq;
use App\Customer;
use App\Product;
use App\Supplier;
use App\Pic;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RfqControllerTest extends TestCase
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

        // Create test data
        Customer::create(['name' => 'Test Customer', 'is_active' => true]);
        Product::create(['name' => 'Test Product', 'is_active' => true]);
        Supplier::create(['name' => 'Test Supplier', 'is_active' => true]);
        Pic::create(['name' => 'Test PIC', 'is_active' => true]);
    }

    /** @test */
    public function it_requires_authentication_to_access_rfq_pages()
    {
        $response = $this->get(route('rfq.index'));
        $this->assertRedirectedTo(route('login'));

        $response = $this->get(route('rfq.create'));
        $this->assertRedirectedTo(route('login'));
    }

    /** @test */
    public function it_displays_rfq_index_page()
    {
        $this->actingAs($this->user);

        Rfq::create([
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN001',
            'part_name' => 'Test Part',
            'std_qty' => 100,
            'qty_month' => 50,
            'due_date' => '2025-12-31',
            'pic_id' => '1',
            'id_supplier' => '1'
        ]);

        $response = $this->get(route('rfq.index'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_create_rfq_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('rfq.create'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_store_a_new_rfq()
    {
        $this->actingAs($this->user);

        $rfqData = [
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN002',
            'part_name' => 'New Test Part',
            'std_qty' => 200,
            'qty_month' => 100,
            'note' => 'Test note',
            'due_date' => '2025-12-31',
            'pic' => 1,
            'id_supplier' => ['1']
        ];

        $response = $this->post(route('rfq.store'), $rfqData);

        // Check if RFQ was saved to database
        $rfq = \DB::table('rfqs')->where('part_number', 'PN002')->first();
        $this->assertNotNull($rfq);
        $this->assertEquals('Test Customer', $rfq->customer);
        $this->assertEquals('Test Product', $rfq->produk);

        $this->assertRedirectedTo(route('rfq.index'));
    }

    /** @test */
    public function it_validates_required_fields_when_storing_rfq()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('rfq.store'), []);

        $this->assertSessionHasErrors('customer');
    }

    /** @test */
    public function it_can_store_rfq_with_file_uploads()
    {
        $this->markTestSkipped('File upload testing not compatible with Laravel 5');
    }

    /** @test */
    public function it_displays_rfq_details()
    {
        $this->actingAs($this->user);

        $rfq = Rfq::create([
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN004',
            'part_name' => 'Display Test Part',
            'std_qty' => 300,
            'qty_month' => 150,
            'note' => 'Display test note',
            'due_date' => '2025-12-31',
            'pic_id' => '1',
            'id_supplier' => '1'
        ]);

        $response = $this->get(route('rfq.show', $rfq->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_edit_rfq_form()
    {
        $this->actingAs($this->user);

        $rfq = Rfq::create([
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN005',
            'part_name' => 'Edit Test Part',
            'std_qty' => 400,
            'qty_month' => 200,
            'due_date' => '2025-12-31',
            'pic_id' => '1',
            'id_supplier' => '1'
        ]);

        $response = $this->get(route('rfq.edit', $rfq->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_update_rfq()
    {
        $this->actingAs($this->user);

        $rfq = Rfq::create([
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN006',
            'part_name' => 'Original Part',
            'std_qty' => 500,
            'qty_month' => 250,
            'due_date' => '2025-12-31',
            'pic_id' => 1,
            'id_supplier' => 1
        ]);

        $updateData = [
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN006-UPDATED',
            'part_name' => 'Updated Part',
            'std_qty' => 600,
            'qty_month' => 300,
            'note' => 'Updated note',
            'due_date' => '2025-12-31',
            'pic' => 1,
            'id_supplier' => ['Supplier 1']
        ];

        $response = $this->put(route('rfq.update', $rfq->id), $updateData);

        $this->seeInDatabase('rfqs', [
            'id' => $rfq->id,
            'part_number' => 'PN006-UPDATED',
            'part_name' => 'Updated Part',
            'std_qty' => 600,
            'note' => 'Updated note'
        ]);

        $this->assertRedirectedTo(route('rfq.index'));
    }

    /** @test */
    public function it_can_delete_rfq()
    {
        $this->actingAs($this->user);

        $rfq = Rfq::create([
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN007',
            'part_name' => 'Delete Test Part',
            'std_qty' => 700,
            'qty_month' => 350,
            'due_date' => '2025-12-31',
            'pic_id' => 1,
            'id_supplier' => 1
        ]);

        $response = $this->delete(route('rfq.destroy', $rfq->id));

        $this->notSeeInDatabase('rfqs', [
            'id' => $rfq->id
        ]);

        $this->assertRedirectedTo(route('rfq.index'));
    }

    /** @test */
    public function it_returns_404_for_non_existent_rfq()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('rfq.show', 99999));
        $this->assertResponseStatus(404);

        $response = $this->get(route('rfq.edit', 99999));
        $this->assertResponseStatus(404);

        $response = $this->put(route('rfq.update', 99999), []);
        $this->assertResponseStatus(404);

        $response = $this->delete(route('rfq.destroy', 99999));
        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_validates_file_types_for_uploads()
    {
        $this->actingAs($this->user);

        // Create a temporary file with invalid extension
        $tempFile = tmpfile();
        fwrite($tempFile, 'test content');
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];
        
        $invalidFile = new UploadedFile(
            $tempFilePath,
            'invalid.txt',
            'text/plain',
            filesize($tempFilePath),
            null,
            true
        );

        $rfqData = [
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN008',
            'part_name' => 'Invalid File Test',
            'std_qty' => 100,
            'qty_month' => 50,
            'due_date' => '2025-12-31',
            'pic' => 1,
            'id_supplier' => ['Test Supplier'],
            'drawing_file' => $invalidFile
        ];

        $response = $this->post(route('rfq.store'), $rfqData);

        // Should have validation errors for file type
        $this->assertSessionHasErrors();
    }

    /** @test */
    public function it_can_send_email_for_rfq()
    {
        $this->actingAs($this->user);

        $rfq = Rfq::create([
            'customer' => 'Test Customer',
            'produk' => 'Test Product',
            'part_number' => 'PN009',
            'part_name' => 'Email Test Part',
            'std_qty' => 100,
            'qty_month' => 50,
            'due_date' => '2025-12-31',
            'pic_id' => 1,
            'id_supplier' => 1
        ]);

        $response = $this->get(route('rfq.sendEmail', $rfq->id));

        // This should redirect to the index page with a success message
        $this->assertRedirectedTo(route('rfq.index'));
    }
}
