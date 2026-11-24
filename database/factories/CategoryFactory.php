<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Real English category names.
     *
     * @var list<string>
     */
    private const CATEGORIES = [
        'Laravel',
        'PHP',
        'JavaScript',
        'Frontend',
        'Backend',
        'DevOps',
        'Testing',
        'Accessibility',
        'Databases',
        'Performance',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::CATEGORIES),
        ];
    }
}
