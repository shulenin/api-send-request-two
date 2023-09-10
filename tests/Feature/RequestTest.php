<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RequestTest extends TestCase
{
    public function testSendRequestWithValidData()
    {
        $user = Sanctum::actingAs(User::factory()->create());

        $route = route('request.send');

        $response = $this->actingAs($user)
            ->post($route, [
                'title' => 'Test title',
                'text' => 'Test text',
            ]);

        $response
            ->assertOk()
            ->assertJson([
                'message' => 'success',
            ]);
    }
}
