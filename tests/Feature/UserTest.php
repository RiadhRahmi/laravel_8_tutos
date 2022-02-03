<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    /**
     * test page not found
     */
    public function test_page_not_found()
    {
        $response = $this->get('/test-page-404');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }


    public function test_an_action_that_requires_authentication()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard')
            ->assertStatus(Response::HTTP_OK);
    }


    public function test_a_welcome_view_can_be_rendered()
    {
        $view = $this->view('welcome', ['name' => 'Taylor']);

        $view->assertSee('Taylor');
    }

    /**
     * Test a console command.
     *
     * @return void
     */
    public function test_console_command()
    {
        $this->artisan('inspire')->assertExitCode(0);
    }


    /**
     * Test a console command.
     *
     * @return void
     */
    public function test_console_command_question()
    {
        $this->artisan('cache:clear')->assertSuccessful();
    }


    public function test_models_can_be_instantiated()
    {
        $users = User::factory()->count(3)->create();

        $this->seed(ProductSeeder::class)->assertDatabaseCount('products', 10);

        $user = User::find(1);

        $user->delete();

        $this->assertDeleted($user);

        $product = Product::find(1);

        $product->delete();

        $this->assertModelMissing($product);
    }
}
