<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Tests\TestCase;
use Faker\Factory as Faker;

class StrarWarsApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $user = UserFactory::new()->createOne();

        $userData = [
            "email" => $user->email,
            "password" => 'password'
        ];

        $Token = $this->post('/api/auth/login',$userData);

        $header = [
            'Authorization' => "Bearer {$Token->json('access_token')}",
        ];

        $response = $this->get('/api/people/',$header);

        $response->assertStatus(200);
    }

    public function test_wrong_password_in_login()
    {
        $user = UserFactory::new()->createOne();

        $userData = [
            "email" => $user->email,
            "password" => '1234'
        ];

        $response = $this->post('/api/auth/login',$userData);

        $response->assertStatus(401);
    }

    public function test_Expired_jwtToken_in_apiCall()
    {
        $user = UserFactory::new()->createOne();

        $userData = [
            "email" => $user->email,
            "password" => 'password'
        ];

        $Token = $this->post('/api/auth/login',$userData);

        $header = [
            'Authorization' => "Bearer {$Token->json('access_token')}",
        ];

        $this->post('/api/auth/logout',[],$header);

        $response = $this->get('/api/people/',$header);

        $response->assertStatus(401);
    }

    public function test_Register_Missing_Field()
    {
        $user = UserFactory::new()->createOne();

        $userData = [
            "name" => $user->name,
            "email" => $user->email,
        ];

        $Register = $this->post('/api/auth/register',$userData);

        $Register->assertStatus(400);
    }

    public function test_Register_Ok_Fields()
    {
        $faker = Faker::create();

        $userData = [
            "name" => $faker->name,
            "email" => $faker->safeEmail,
            "password" => 'password'
        ];

        $Register = $this->post('/api/auth/register',$userData);

        $Register->assertStatus(201);
    }


}
