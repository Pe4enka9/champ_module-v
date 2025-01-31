<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GagarinController extends Controller
{
    public function gagarinFlight(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Login failed'], 403);
        }

        return response()->json([
            'data' => [
                [
                    'mission' => [
                        'name' => 'Восток 1',
                        'launch_details' => [
                            'launch_date' => '1961-04-12',
                            'launch_site' => [
                                'name' => 'Космодром Байконур',
                                'location' => [
                                    'latitude' => '45.9650000',
                                    'longitude' => '63.3050000',
                                ],
                            ],
                        ],
                        'flight_duration' => [
                            'hours' => 1,
                            'minutes' => 48,
                        ],
                        'spacecraft' => [
                            'name' => 'Восток 3KA',
                            'manufacturer' => 'OKB-1',
                            'crew_capacity' => 1,
                        ],
                    ],
                    'landing' => [
                        'date' => '1961-04-12',
                        'site' => [
                            'name' => 'Смеловка',
                            'country' => 'СССР',
                            'coordinates' => [
                                'latitude' => '51.2700000',
                                'longitude' => '45.9970000',
                            ],
                        ],
                        'details' => [
                            'parachute_landing' => true,
                            'impact_velocity_mps' => 7,
                        ],
                    ],
                    'cosmonaut' => [
                        'name' => 'Юрий Гагарин',
                        'birthdate' => '1934-03-09',
                        'rank' => 'Старший лейтенант',
                        'bio' => [
                            'early_life' => 'Родился в Клушино, Россия.',
                            'career' => 'Отобран в отряд космонавтов в 1960 году...',
                            'post_flight' => 'Стал международным героем.',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
