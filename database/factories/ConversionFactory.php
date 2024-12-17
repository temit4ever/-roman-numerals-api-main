<?php

namespace Database\Factories;

use App\Models\Conversion;
use App\Services\Contracts\IntegerConverterService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
{
    protected $model = Conversion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate first the random integer within the valid range (1–3999)
        $integerValue = $this->faker->numberBetween(1, 3999);

        // Then convert the integer to Roman numeral using one of the integer convert service method
        $romanConverter = new IntegerConverterService();
        $romanValue = $romanConverter->convertInteger($integerValue);

        return [
            'integer_value' => $integerValue,
            'roman_value' => $romanValue,
        ];
    }
}
