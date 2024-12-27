<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegistrationRequest;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
            
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $expiresAt = Carbon::now()->addMinutes(60);

        $success['token'] = $user->createToken('be-iban-validator-app', ["*"], $expiresAt)->plainTextToken;
        $success['name'] = $user->name;

        $user->markEmailAsVerified();

        return $this->sendResponse($success, 'User register successfully.');

    }

}
