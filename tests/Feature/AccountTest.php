<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use App\Services\GeoCoordinatesApiService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use DatabaseTransactions;

    public function test_register()
    {
        $this->mockGeoCoordinate();

        $client = Client::factory()->make();

        $user = User::factory()->make();

        $payload = $this->getPayload($client, $user);

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('clients',[
            'client_name' => $client->client_name,
            'city' => $client->city,
            'state' => $client->state,
            'latitude' => 50.450001,
            'longitude' => 30.523333,
            'country' => $client->country,
            'zip' => $client->zip,
            'status' => $client->status,
        ]);

        $this->assertDatabaseHas('users',[
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'last_password_reset' => $user->last_password_reset,
            'status' => $user->status,
        ]);
    }

    public function test_list()
    {
        $client = Client::factory()->create();

        User::factory()->create([
            'client_id' => $client->getKey(),
        ]);

        $this->get('/api/account')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    0 => [
                        'id',
                        'name',
                        'address1',
                        'address2',
                        'city',
                        'state',
                        'country',
                        'zipCode',
                        'latitude',
                        'longitude',
                        'phoneNo1',
                        'phoneNo2',
                        'totalUser' => [
                            'all',
                            'active',
                            'inactive',
                        ],
                        'startValidity',
                        'endValidity',
                        'status',
                        'createdAt',
                        'updateAt',
                    ],
                ],
                'links' => [
                    'path',
                    'firstPageUrl',
                    'lastPageUrl',
                    'nextPageUrl',
                    'prevPageUrl',
                ],
                'meta' => [
                    'currentPage',
                    'from',
                    'lastPage',
                    'perPage',
                    'to',
                    'total',
                    'count',
                ],
        ]);
    }

    protected function getPayload($client, $user)
    {
        return [
            'name' => $client->client_name,
            'address1' => $client->address1,
            'address2' => $client->address2,
            'city' => $client->city,
            'state' => $client->state,
            'country' => $client->country,
            'zipCode' => $client->zip,
            'phoneNo1' => $client->phone_no1,
            'phoneNo2' => $client->phone_no2,
            'user' => [
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                'email' => $user->email,
                'password' => $user->password,
                'passwordConfirmation' => $user->password,
                'phone' => $user->phone,
            ],
        ];
    }

    protected function mockGeoCoordinate()
    {
        $this->app->bind(GeoCoordinatesApiService::class, function () {
            $mock = $this->getMockBuilder(GeoCoordinatesApiService::class)
                ->disableOriginalConstructor()
                ->setMethods(['getCoordinatesByAddress'])
                ->getMock();
            $mock
                ->expects($this->any())
                ->method('getCoordinatesByAddress')
                ->willReturn(
                    [
                        'lat' => 50.450001,
                        'lng' => 30.523333,
                    ]
                );

            return $mock;
        });
    }
}
