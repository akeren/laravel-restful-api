<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'proudct_title' => $this->faker->text(30),
            'price' => $this->faker->numberBetween(10, 100),
            'quantity' => $this->faker->numberBetween(1,5),
        ];
    }
}
