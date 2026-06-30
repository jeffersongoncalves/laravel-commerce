<?php

namespace JeffersonGoncalves\Commerce\Pricing\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Pricing\Enums\PriceListStatus;
use JeffersonGoncalves\Commerce\Pricing\Enums\PriceListType;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceList;

/**
 * @extends Factory<PriceList>
 */
class PriceListFactory extends Factory
{
    protected $model = PriceList::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'status' => PriceListStatus::Draft,
            'type' => PriceListType::Sale,
            'metadata' => null,
        ];
    }
}
