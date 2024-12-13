<?php

namespace Tests\Feature;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
     use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_an_order_can_be_stored_to_the_database(): void
    {
        $response = $this->post('orders',[
            'label' => 'Une nouvelle commande',
            'sends_at' => Carbon::tomorrow()
        ]);

       // $response->assertOk();
        $response->assertRedirect(route('welcome'));
        $this->assertCount(1, Order::all());
    }

    public function test_label_and_sends_data_at_cannot_be_null(): void
    {
       // $this->withoutExceptionHandling();
        $response = $this->post('orders',[
            'label' => '',
            'sends_at' => ''
        ]);

        // $response->assertOk();
        $response->assertSessionHasErrors('label','sends_at');
    }

    public function test_an_order_can_be_updated_to_the_database(): void
    {
      $this->post('orders',[
            'label' => 'Une nouvelle commande',
            'sends_at' => Carbon::tomorrow()
        ]);
        $order = Order::first();

        $response = $this->put('orders/' .$order->id,[
            'label' => 'Une commande éditée',
            'sends_at' => Carbon::now()->addDay(2)
        ]);

        $this->assertEquals('Une commande éditée', Order::first()->label);
        $this->assertEquals(Carbon::now()->addDay(2), Order::first()->sends_at);

        $response->assertRedirect(route('orders.show', $order));
    }

    public function test_an_order_can_be_deleted_to_the_database(): void
    {
        $this->withoutExceptionHandling();

        $this->post('orders',[
            'label' => 'Une nouvelle commande',
            'sends_at' => Carbon::tomorrow()
        ]);
        $order = Order::first();

        $response = $this->delete('orders/' .$order->id);

        $this->assertCount(0, Order::all());

        $response->assertRedirect(route('welcome '));
    }

}
