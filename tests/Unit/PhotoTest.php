<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_model_photo_exist()
    {
        $photo = Photo::factory()->create();
        $this->assertModelExists($photo);
    }

    public function test_creation_photo_is_working()
    {
        $photo = new Photo;
        $this->assertInstanceOf(Photo::class, $photo);
    }

 /*    public function test_some_photos_has_one_user()
    {
        $user = User::factory()->create();

        $photo = Photo::factory()
                        ->count(3)
                        ->for($user)
                        ->create();
        
        $this->assertEquals(1, $photo->users->count());
    } */
}
