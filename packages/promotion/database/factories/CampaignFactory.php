<?php

namespace JeffersonGoncalves\Commerce\Promotion\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Promotion\Models\Campaign;

/**
 * @extends Factory<Campaign>
 */
class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'campaign_identifier' => $this->faker->unique()->bothify('CAMP-####'),
            'description' => $this->faker->sentence(),
            'metadata' => null,
        ];
    }
}
