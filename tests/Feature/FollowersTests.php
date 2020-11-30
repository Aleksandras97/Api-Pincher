<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowersTests extends TestCase
{
    /** @test */
    public function only_loggen_in_users_can_see_the_timeline()
    {
        $response = $this->get('timeline')->assertRedirect('login') ;
    }


}
