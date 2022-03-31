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
        $photo = Photo::factory(10)->create();
        //$photo = new Photo;
        $this->assertModelExists($photo);
    }

    public function test_creation_photo_is_working()
    {
        $photo = new Photo;
        $this->assertInstanceOf(Photo::class, $photo);
    }

    public function test_some_photos_has_one_user()
    {
        $user = User::factory()->create();

        $photo = Photo::factory(3)
                        //->count(3)
                        ->for($user)
                        ->create();
        
        $this->assertEquals(1, $photo->users()->count());
    }

    public function test_route_get_all_photos()
    {
        //Given
        $photos = Photo::factory(10)->create();

        //When        
        $response = $this->json('GET','livewire.photos.index');
        
        //Then
        $response->assertStatus(200)
            ->assertJsonCount(10)
            ->assertExactJson($photos->toArray());
    }

    public function test_route_create_a_photo()
    {
        $photo = Photo::factory(1)->create();
        
        $data = [
            'title' => 'Foto de familia',
            'image' => 'http://www.example.com',
        ];

       // $photo->store();

        
        //$response->dd();
        //$response->assertStatus(200);
            
    }
}
