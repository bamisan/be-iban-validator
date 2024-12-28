<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
            
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        try {

            $user = User::create($data);

            $user = $user->fresh();

            $success['token'] = $user->createToken('be-iban-validator-app')->plainTextToken;
            $success['name'] = $user->name;
            $success['is_admin'] = $user->is_admin;

            $user->markEmailAsVerified();

            return $this->sendResponse($success, 'User register successfully.');

        } catch (\Exception $e) {

            Log::error('Registration failed: ' . $e->getMessage());
            return $this->sendError('Registration failed due to a server error.', [], 500);

        }

    }

    public function login(LoginRequest $request)
    {

        $data = $request->validated();

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return $this->sendError('Invalid credentials.', ['error' => 'Unauthorised'], 401);
        }

        try {

            $user = Auth::user();

            $success['token'] = $user->createToken('be-iban-validator-app')->plainTextToken;
            $success['name'] = $user->name;
            $success['is_admin'] = $user->is_admin;        

            return $this->sendResponse($success, 'User login successfully.');

        } catch (\Exception $e) {

            Log::error('Login failed: ' . $e->getMessage());
            return $this->sendError('Login failed due to a server error.', [], 500);

        }
    }

}
