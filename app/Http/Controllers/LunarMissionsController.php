<?php

namespace App\Http\Controllers;

use App\Models\LunarMission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LunarMissionsController extends Controller
{
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

    public function addLunarMissions(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Login failed'], 403);
        }

        $validator = Validator::make($request->all(), [
            'mission.name' => ['required', 'string', 'max:255'],
            'mission.launch_details.launch_date' => ['required', 'date_format:Y-m-d'],
            'mission.launch_details.launch_site.name' => ['required', 'string', 'max:255'],
            'mission.launch_details.launch_site.location.latitude' => ['required', 'numeric'],
            'mission.launch_details.launch_site.location.longitude' => ['required', 'numeric'],
            'mission.landing_details.landing_date' => ['required', 'date_format:Y-m-d'],
            'mission.landing_details.landing_site.name' => ['required', 'string', 'max:255'],
            'mission.landing_details.landing_site.coordinates.latitude' => ['required', 'numeric'],
            'mission.landing_details.landing_site.coordinates.longitude' => ['required', 'numeric'],
            'mission.spacecraft.command_module' => ['required', 'string', 'max:255'],
            'mission.spacecraft.lunar_module' => ['required', 'string', 'max:255'],
            'mission.spacecraft.crew' => ['required', 'array', 'min:1'],
            'mission.spacecraft.crew.*.name' => ['required', 'string', 'max:255'],
            'mission.spacecraft.crew.*.role' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ],
            ], 422);
        }

        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Миссия добавлена',
            ],
        ], 201);
    }

    public function deleteLunarMission(Request $request, int $id): JsonResponse | Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Login failed'], 403);
        }

        $mission = LunarMission::query()->find($id);

        if (!$mission) {
            return response()->json(['message' => 'Not found', 'code' => 404], 404);
        }

        $mission->delete();

        return response()->noContent();
    }
}
