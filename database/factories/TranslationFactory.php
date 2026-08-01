<?php

namespace JeffersonGoncalves\Commerce\Translation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Translation\Models\Translation;

/**
 * @extends Factory<Translation>
 */
class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    public function definition(): array
    {
        return [
            'translatable_type' => 'product',
            'translatable_id' => 'prod_'.$this->faker->lexify('??????'),
            'locale' => $this->faker->randomElement(['en', 'pt_BR', 'es']),
            'field' => 'title',
            'value' => $this->faker->words(3, true),
        ];
    }
}
