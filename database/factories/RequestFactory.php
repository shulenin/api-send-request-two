<?php

namespace Database\Factories;

use App\Models\Request;
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
            $data['status'] = Request::PENDING_STATUS;
            $data['answer'] = null;
        } else {
            $data['status'] = Request::ANSWERED_STATUS;
            $data['answer'] = $this->faker->text;
        }

        return $data;
    }
}
