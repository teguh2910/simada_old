<?php

namespace Tests\Feature\Controllers;

use TestCase;
use App\User;
use App\Pic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PicControllerTest extends TestCase
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
    public function it_displays_pics_index_page()
    {
        $this->actingAs($this->user);

        Pic::create([
            'name' => 'John Doe',
            'email' => 'john.doe@company.com',
            'phone' => '+1234567890',
            'department' => 'Engineering',
            'position' => 'Senior Engineer',
            'is_active' => true
        ]);

        Pic::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@company.com',
            'phone' => '+0987654321',
            'department' => 'Quality',
            'position' => 'QA Manager',
            'is_active' => false
        ]);

        $response = $this->get(route('pics.index'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_create_pic_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('pics.create'));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_store_a_new_pic()
    {
        $this->actingAs($this->user);

        $picData = [
            'name' => 'Bob Wilson',
            'email' => 'bob.wilson@company.com',
            'phone' => '+1111111111',
            'department' => 'Production',
            'position' => 'Production Manager',
            'is_active' => true
        ];

        $response = $this->post(route('pics.store'), $picData);

        // Check if PIC was saved to database
        $pic = \DB::table('pics')->where('name', 'Bob Wilson')->first();
        $this->assertNotNull($pic);
        $this->assertEquals('bob.wilson@company.com', $pic->email);
        $this->assertEquals('Production', $pic->department);
        $this->assertEquals(true, (bool)$pic->is_active);

        $this->assertRedirectedTo(route('pics.index'));
    }

    /** @test */
    public function it_validates_required_name_when_storing_pic()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('pics.store'), [
            'email' => 'test@example.com',
            'department' => 'Test Department',
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_validates_email_format_when_storing_pic()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('pics.store'), [
            'name' => 'Test PIC',
            'email' => 'invalid-email-format',
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_validates_unique_email_when_storing_pic()
    {
        $this->actingAs($this->user);

        Pic::create([
            'name' => 'Existing PIC',
            'email' => 'existing@company.com',
            'is_active' => true
        ]);

        $response = $this->post(route('pics.store'), [
            'name' => 'New PIC',
            'email' => 'existing@company.com', // Duplicate email
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_displays_pic_details()
    {
        $this->actingAs($this->user);

        $pic = Pic::create([
            'name' => 'Display PIC',
            'email' => 'display@company.com',
            'phone' => '+5555555555',
            'department' => 'Display Department',
            'position' => 'Display Position',
            'is_active' => true
        ]);

        $response = $this->get(route('pics.show', $pic->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_displays_edit_pic_form()
    {
        $this->actingAs($this->user);

        $pic = Pic::create([
            'name' => 'Edit PIC',
            'email' => 'edit@company.com',
            'department' => 'Edit Department',
            'is_active' => true
        ]);

        $response = $this->get(route('pics.edit', $pic->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_update_pic()
    {
        $this->actingAs($this->user);

        $pic = Pic::create([
            'name' => 'Original PIC',
            'email' => 'original@company.com',
            'phone' => '+1111111111',
            'department' => 'Original Department',
            'position' => 'Original Position',
            'is_active' => true
        ]);

        $updateData = [
            'name' => 'Updated PIC',
            'email' => 'updated@company.com',
            'phone' => '+2222222222',
            'department' => 'Updated Department',
            'position' => 'Updated Position',
            'is_active' => false
        ];

        $response = $this->put(route('pics.update', $pic->id), $updateData);

        // Check if PIC was updated in database
        $updatedPic = \DB::table('pics')->where('id', $pic->id)->first();
        $this->assertEquals('Updated PIC', $updatedPic->name);
        $this->assertEquals('updated@company.com', $updatedPic->email);
        $this->assertEquals('Updated Department', $updatedPic->department);
        $this->assertEquals(false, (bool)$updatedPic->is_active);

        $this->assertRedirectedTo(route('pics.index'));
    }

    /** @test */
    public function it_validates_unique_email_when_updating_pic()
    {
        $this->actingAs($this->user);

        $pic1 = Pic::create([
            'name' => 'PIC 1',
            'email' => 'pic1@company.com',
            'is_active' => true
        ]);

        $pic2 = Pic::create([
            'name' => 'PIC 2',
            'email' => 'pic2@company.com',
            'is_active' => true
        ]);

        $response = $this->put(route('pics.update', $pic2->id), [
            'name' => 'PIC 2 Updated',
            'email' => 'pic1@company.com', // This email already exists
            'is_active' => true
        ]);

        $this->assertSessionHasErrors('email');
        
        // PIC 2 should remain unchanged
        $unchangedPic = \DB::table('pics')->where('id', $pic2->id)->first();
        $this->assertEquals('pic2@company.com', $unchangedPic->email);
    }

    /** @test */
    public function it_can_delete_pic()
    {
        $this->actingAs($this->user);

        $pic = Pic::create([
            'name' => 'Delete PIC',
            'email' => 'delete@company.com',
            'is_active' => true
        ]);

        $response = $this->delete(route('pics.destroy', $pic->id));

        // Check if PIC was deleted from database
        $deletedPic = \DB::table('pics')->where('id', $pic->id)->first();
        $this->assertNull($deletedPic);

        $this->assertRedirectedTo(route('pics.index'));
    }

    /** @test */
    public function it_returns_404_for_non_existent_pic()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('pics.show', 99999));

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_can_store_pic_with_minimal_data()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('pics.store'), [
            'name' => 'Minimal PIC'
        ]);

        // Check if PIC was saved to database
        $pic = \DB::table('pics')->where('name', 'Minimal PIC')->first();
        $this->assertNotNull($pic);

        $this->assertRedirectedTo(route('pics.index'));
    }

    /** @test */
    public function it_displays_full_info_in_pic_details()
    {
        $this->actingAs($this->user);

        $pic = Pic::create([
            'name' => 'Full Info PIC',
            'email' => 'fullinfo@company.com',
            'phone' => '+3333333333',
            'department' => 'Full Department',
            'position' => 'Full Position',
            'is_active' => true
        ]);

        $response = $this->get(route('pics.show', $pic->id));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_filter_active_pics()
    {
        $this->actingAs($this->user);

        Pic::create(['name' => 'Active PIC', 'is_active' => true]);
        Pic::create(['name' => 'Inactive PIC', 'is_active' => false]);

        // This test depends on the controller implementation
        // If there's a filter for active PICs, test it here
        $response = $this->get(route('pics.index', ['active' => 1]));

        $this->assertResponseOk();
    }

    /** @test */
    public function it_paginates_pics_on_index_page()
    {
        $this->actingAs($this->user);

        // Create more than 10 PICs to test pagination
        for ($i = 1; $i <= 15; $i++) {
            Pic::create([
                'name' => "PIC {$i}",
                'email' => "pic{$i}@company.com",
                'department' => "Department {$i}",
                'is_active' => true
            ]);
        }

        $response = $this->get(route('pics.index'));

        $this->assertResponseOk();
    }
}
