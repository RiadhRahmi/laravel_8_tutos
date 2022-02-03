<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    // Resetting The Database After Each Test
    use RefreshDatabase;

    protected $product;

    // initialize data
    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::create([
            'name' => 'Car',
            'price' => 100
        ]);
    }

    /**
     * test page products
     *
     * @return void
     */
    public function test_user_can_list_products()
    {
        $response = $this->get('/products');

        $response->assertStatus(200)
            ->assertSee('Car');
    }

    /**
     * test page detail product
     *
     * @return void
     */
    public function test_user_can_see_product_details()
    {
        $response = $this->get('/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertSee('Car')
            ->assertSee('100');
    }
}
