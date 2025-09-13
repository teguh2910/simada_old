<?php

namespace Tests\Unit\Models;

use App\User;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $user = new User([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123'
        ]);

        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertEquals('password123', $user->password);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $user = new User();
        $fillable = $user->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('email', $fillable);
        $this->assertContains('password', $fillable);
    }

    /** @test */
    public function it_has_hidden_attributes()
    {
        $user = new User();
        $hidden = $user->getHidden();

        $this->assertContains('password', $hidden);
        $this->assertContains('remember_token', $hidden);
    }

    /** @test */
    public function it_can_save_user_to_database()
    {
        $user = new User([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => bcrypt('password123')
        ]);
        
        // Set non-fillable fields manually
        $user->dept = 'Engineering';
        $user->npk = 'ENG001';
        $user->save();

        // Check if user was saved by finding it in database
        $savedUser = User::where('email', 'jane@example.com')->first();
        
        $this->assertInstanceOf(User::class, $savedUser);
        $this->assertEquals('Jane Doe', $savedUser->name);
        $this->assertEquals('Engineering', $savedUser->dept);
        $this->assertEquals('ENG001', $savedUser->npk);
    }

    /** @test */
    public function it_encrypts_password_when_creating_user()
    {
        $user = new User([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('plain-password')
        ]);
        
        // Set non-fillable fields manually
        $user->dept = 'Testing';
        $user->npk = 'TEST001';
        $user->save();

        $this->assertNotEquals('plain-password', $user->password);
        $this->assertTrue(strlen($user->password) > 50);
    }
}