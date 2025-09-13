<?php

namespace Tests\Unit\Models;

use App\Pic;
use App\Rfq;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PicTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $pic = new Pic([
            'name' => 'John Doe',
            'email' => 'john.doe@company.com',
            'phone' => '+1234567890',
            'department' => 'Engineering',
            'position' => 'Senior Engineer',
            'is_active' => true
        ]);

        $this->assertEquals('John Doe', $pic->name);
        $this->assertEquals('john.doe@company.com', $pic->email);
        $this->assertEquals('+1234567890', $pic->phone);
        $this->assertEquals('Engineering', $pic->department);
        $this->assertEquals('Senior Engineer', $pic->position);
        $this->assertTrue($pic->is_active);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $pic = new Pic();
        $fillable = $pic->getFillable();

        $expected = ['name', 'email', 'phone', 'department', 'position', 'is_active'];
        
        foreach ($expected as $attribute) {
            $this->assertContains($attribute, $fillable);
        }
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $pic = new Pic();
        $casts = $pic->getCasts();

        $this->assertEquals('boolean', $casts['is_active']);
    }

    /** @test */
    public function it_has_many_rfqs()
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            (new Pic())->rfqs()
        );
    }

    /** @test */
    public function it_can_scope_active_pics()
    {
        $pic = new Pic();
        $query = $pic->newQuery();
        
        $scopedQuery = $pic->scopeActive($query);
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $scopedQuery);
    }

    /** @test */
    public function it_generates_full_info_with_all_details()
    {
        $pic = new Pic([
            'name' => 'Jane Smith',
            'position' => 'Project Manager',
            'department' => 'Operations'
        ]);

        $expected = 'Jane Smith (Project Manager) - Operations';
        $this->assertEquals($expected, $pic->full_info);
    }

    /** @test */
    public function it_generates_full_info_with_position_only()
    {
        $pic = new Pic([
            'name' => 'Bob Wilson',
            'position' => 'Developer',
            'department' => null
        ]);

        $expected = 'Bob Wilson (Developer)';
        $this->assertEquals($expected, $pic->full_info);
    }

    /** @test */
    public function it_generates_full_info_with_department_only()
    {
        $pic = new Pic([
            'name' => 'Alice Johnson',
            'position' => null,
            'department' => 'HR'
        ]);

        $expected = 'Alice Johnson - HR';
        $this->assertEquals($expected, $pic->full_info);
    }

    /** @test */
    public function it_generates_full_info_with_name_only()
    {
        $pic = new Pic([
            'name' => 'Charlie Brown',
            'position' => null,
            'department' => null
        ]);

        $expected = 'Charlie Brown';
        $this->assertEquals($expected, $pic->full_info);
    }

    /** @test */
    public function it_can_save_pic_to_database()
    {
        $pic = Pic::create([
            'name' => 'Test PIC',
            'email' => 'test.pic@company.com',
            'phone' => '+1111111111',
            'department' => 'Quality Assurance',
            'position' => 'QA Lead',
            'is_active' => true
        ]);

        // Verify in database using direct query
        $savedPic = Pic::where('name', 'Test PIC')
                       ->where('email', 'test.pic@company.com')
                       ->where('department', 'Quality Assurance')
                       ->first();
        
        $this->assertInstanceOf(Pic::class, $savedPic);
        $this->assertEquals('Test PIC', $savedPic->name);
        $this->assertEquals('test.pic@company.com', $savedPic->email);
        $this->assertEquals('Quality Assurance', $savedPic->department);

        $this->assertInstanceOf(Pic::class, $pic);
        $this->assertEquals('Test PIC', $pic->name);
    }

    /** @test */
    public function it_can_be_created_with_minimal_data()
    {
        $pic = Pic::create([
            'name' => 'Minimal PIC'
        ]);

        // Verify in database using direct query
        $savedPic = Pic::where('name', 'Minimal PIC')->first();
        
        $this->assertInstanceOf(Pic::class, $savedPic);
        $this->assertEquals('Minimal PIC', $savedPic->name);

        $this->assertEquals('Minimal PIC', $pic->name);
        $this->assertEquals('Minimal PIC', $pic->full_info);
    }

    /** @test */
    public function it_can_be_inactive()
    {
        $pic = Pic::create([
            'name' => 'Inactive PIC',
            'is_active' => false
        ]);

        // Verify in database using direct query
        $savedPic = Pic::where('name', 'Inactive PIC')->first();
        
        $this->assertInstanceOf(Pic::class, $savedPic);
        $this->assertEquals('Inactive PIC', $savedPic->name);
        $this->assertFalse($savedPic->is_active);

        $this->assertFalse($pic->is_active);
    }
}
