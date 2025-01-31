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

    public function flight(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Login failed'], 403);
        }

        return response()->json([
            'data' => [
                'name' => 'Аполлон-11',
                'crew_capacity' => 3,
                'cosmonaut' => [
                    [
                        'name' => 'Нил Армстронг',
                        'role' => 'Командир',
                    ],
                    [
                        'name' => 'Базз Олдрин',
                        'role' => 'Пилот лунного модуля',
                    ],
                    [
                        'name' => 'Майкл Коллинз',
                        'role' => 'Пилот командного модуля',
                    ],
                ],
                'launch_details' => [
                    'launch_date' => '1969-07-16',
                    'launch_site' => [
                        'name' => 'Космический центр имени Кеннеди',
                        'latitude' => '28.5721000',
                        'longitude' => '-80.6480000',
                    ],
                ],
                'landing_details' => [
                    'landing_date' => '1969-07-20',
                    'landing_site' => [
                        'name' => 'Море спокойствия',
                        'latitude' => '0.6740000',
                        'longitude' => '23.4720000',
                    ],
                ],
            ],
        ]);
    }

    public function lunarMissions(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Login failed'], 403);
        }

        return response()->json([
            [
                'mission' => [
                    'name' => 'Аполлон-11',
                    'launch_details' => [
                        'launch_date' => '1969-07-16',
                        'launch_site' => [
                            'name' => 'Космический центр имени Кеннеди',
                            'location' => [
                                'latitude' => '28.5721000',
                                'longitude' => '-80.6480000',
                            ],
                        ],
                    ],
                    'landing_details' => [
                        'landing_date' => '1969-07-20',
                        'landing_site' => [
                            'name' => 'Море спокойствия',
                            'coordinates' => [
                                'latitude' => '0.6740000',
                                'longitude' => '23.4720000',
                            ],
                        ],
                    ],
                    'spacecraft' => [
                        'command_module' => 'Колумбия',
                        'lunar_module' => 'Орел',
                        'crew' => [
                            [
                                'name' => 'Нил Армстронг',
                                'role' => 'Командир',
                            ],
                            [
                                'name' => 'Базз Олдрин',
                                'role' => 'Пилот лунного модуля',
                            ],
                            [
                                'name' => 'Майкл Коллинз',
                                'role' => 'Пилот командного модуля',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'mission' => [
                    'name' => 'Аполлон-17',
                    'launch_details' => [
                        'launch_date' => '1972-12-07',
                        'launch_site' => [
                            'name' => 'Космический центр имени Кеннеди',
                            'location' => [
                                'latitude' => '28.5721000',
                                'longitude' => '-80.6480000',
                            ],
                        ],
                    ],
                    'landing_details' => [
                        'landing_date' => '1972-12-19',
                        'landing_site' => [
                            'name' => 'Телец-Литтров',
                            'coordinates' => [
                                'latitude' => '20.1908000',
                                'longitude' => '30.7717000',
                            ],
                        ],
                    ],
                    'spacecraft' => [
                        'command_module' => 'Америка',
                        'lunar_module' => 'Челленджер',
                        'crew' => [
                            [
                                'name' => 'Евгений Сернан',
                                'role' => 'Командир',
                            ],
                            [
                                'name' => 'Харрисон Шмитт',
                                'role' => 'Пилот лунного модуля',
                            ],
                            [
                                'name' => 'Рональд Эванс',
                                'role' => 'Пилот командного модуля',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
