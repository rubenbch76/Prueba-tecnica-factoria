<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    public function test_creation_user_is_working()
    {
        $user = new User;
        //$user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
    }
    public function test_a_user_has_many_photos()
    {
        //$user = new User;
        $user = User::factory()->create();
        $this->assertInstanceOf(Collection::class, $user->photos);
    }
}
