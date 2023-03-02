<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Commodity;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommodityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commodity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'image' => 'https://source.unsplash.com/random',
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Commodity $commodity) {
            // the number of historical days created
            $randomNumber = $this->faker->numberBetween(15, 250);

            $historicalPriceData = [];
            for ($i = $randomNumber; $i >= 1; $i--) {
                $randomPrice = $this->faker->numberBetween(5000, 150000);
                array_push($historicalPriceData, [
                    'commodity_id' => $commodity->id,
                    'price' => $randomPrice,
                    'created_at' => Carbon::now()->subDays($i)->toDateTimeString(),
                ]);
            }

            $commodity->prices()->insert($historicalPriceData);
        });
    }
}
