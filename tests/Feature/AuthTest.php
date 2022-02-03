<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test if user not authenticated redirected to login page
     */
    public function test_it_redirects_guest_to_login_when_he_visit_home_page()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * test if user authenticated can visit dashboard
     */
    public function test_it_allow_logged_in_user_to_visit_home_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertOk();
    }
}
