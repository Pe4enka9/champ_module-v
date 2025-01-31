<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function registration(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'regex:/^[А-ЯЁA-Z][а-яёa-z]+$/u'],
            'last_name' => ['required', 'string', 'regex:/^[А-ЯЁA-Z][а-яёa-z]+$/u'],
            'patronymic' => ['required', 'string', 'regex:/^[А-ЯЁA-Z][а-яёa-z]+$/u'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{3,}$/'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
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

        $validated = $validator->validated();

        User::query()->create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'patronymic' => $validated['patronymic'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'birth_date' => $validated['birth_date'],
        ]);

        return response()->json([
            'data' => [
                'user' => [
                    'name' => "$validated[first_name] $validated[last_name] $validated[patronymic]",
                    'email' => $validated['email'],
                ],
                'code' => 201,
                'message' => 'Пользователь создан',
            ],
        ], 201);
    }

    public function authorization(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
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

        $user = User::query()->where('email', $request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json([
                'message' => 'Login failed',
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => "$user->first_name $user->last_name $user->patronymic",
                    'birth_date' => $user->birth_date,
                    'email' => $user->email,
                ],
                'token' => $token,
            ],
        ]);
    }

    public function logout(Request $request): Response
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}
