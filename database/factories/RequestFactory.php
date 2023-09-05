<?php

namespace Database\Factories;

use App\Enums\RequestType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    public function definition(): array
    {
        $data = [
            'title' => $this->faker->word,
            'text' => $this->faker->text,
        ];

        if ($this->faker->boolean) {
            $data['status'] = RequestType::Pending;
            $data['answer'] = null;
        } else {
            $data['status'] = RequestType::Answered;
            $data['answer'] = $this->faker->text;
        }

        return $data;
    }
}
