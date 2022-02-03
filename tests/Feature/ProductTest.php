<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
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
     */
    public function test_user_can_list_products()
    {
        $response = $this->get('/products');

        $response->assertStatus(200)
            ->assertSee('Car');
    }

    /**
     * test page detail product
     */
    public function test_user_can_see_product_details()
    {
        $response = $this->get('/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertSee('Car')
            ->assertSee('100');
    }



    /**
     * test relationships in laravel
     */
    public function test_a_product_can_belongs_to_a_category()
    {
        // arrange
        $product = Product::factory()->create();
        $category = Category::factory()->create();

        // assert
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'category_id' => $category->id,
        ]);

        // act
        $product->setCategory($category);

        // assert
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $category->id,
        ]);
    }


    /**
     *  assert Exception Example
     */
    public function test_it_prevent_changing_the_product_category()
    {
        $product = Product::factory()->create();
        $category = Category::factory()->create();
        $category2 = Category::factory()->create();

        $product->setCategory($category);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('You can not change the product category');

        $product->setCategory($category2);
    }
}
