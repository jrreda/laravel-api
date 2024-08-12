<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function () {
    $credentials = [
        'email'    => 'admin@example.com',
        'password' => 'password',
    ];

    if (!Auth::attempt($credentials)) {
        $user = new User();

        $user->name     = 'Admin';
        $user->email    = $credentials['email'];
        $user->password = bcrypt($credentials['password']);
        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $adminToken  = $user->createToken('admin-tocken', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update-tocken', ['create', 'update']);
            $basicToken  = $user->createToken('basic-tocken');

            return [
                'basic'  => $basicToken,
                'update' => $updateToken,
                'basic'  => $basicToken,
            ];
        }
    }
});
