<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    Route::post('/register', [
        AuthController::class,
        'register'
    ])->middleware('throttle:register');

    Route::post('/login', [
        AuthController::class,
        'login'
    ])->middleware('throttle:login');

    /*
    |--------------------------------------------------------------------------
    | Email Verification
    |--------------------------------------------------------------------------
    */

    Route::get('/email/verify/{id}/{hash}', function (
        Request $request,
        $id,
        $hash
    ) {

        $user = User::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validate Verification Hash
        |--------------------------------------------------------------------------
        */

        if (! hash_equals(
            sha1($user->getEmailForVerification()),
            $hash
        )) {

            return response()->json([
                'success' => false,
                'message' => 'Invalid verification link'
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Already Verified
        |--------------------------------------------------------------------------
        */

        if ($user->hasVerifiedEmail()) {

            return response()->json([
                'success' => true,
                'message' => 'Email already verified'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Verify Email
        |--------------------------------------------------------------------------
        */

        $user->markEmailAsVerified();

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully'
        ]);
    })->middleware('signed')
      ->name('verification.verify');

    /*
    |--------------------------------------------------------------------------
    | Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

        Route::get('/me', [
            AuthController::class,
            'me'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [
            AuthController::class,
            'logout'
        ]);
    });
});