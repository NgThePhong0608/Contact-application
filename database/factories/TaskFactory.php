<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attribute) {
            return [
                'status' => true
            ];
        });
    }

    public function uncompleted()
    {
        return $this->state(function (array $attribute) {
            return [
                'status' => false
            ];
        });
    }

    public function tomorrow()
    {
        return $this->state(function (array $attribute) {
            return [
                'due_at' => now()->addDay()
            ];
        });
    }

    public function priority($level = 1)
    {
        return $this->state(
            fn (array $attribute) => [
                'priority' => $level
            ]
        );
    }
}
