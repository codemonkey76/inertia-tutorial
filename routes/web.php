<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login', [LoginController::class, 'create'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::get('/users', function () {
        return Inertia::render('Users/Index', [
            'users'   => User::query()
                             ->when(Request::input('search'),
                                 fn($query, $search) => $query->where('name', 'like', "%{$search}%")
                             )
                             ->paginate(10)
                             ->withQueryString()
                             ->through(fn($user) => [
                                 'id'   => $user->getKey(),
                                 'name' => $user->name
                             ]),
            'filters' => Request::only('search')

        ]);
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    });

    Route::post('/users', function () {
        sleep(3);
        $validated = Request::validate([
            'name'     => ['required', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => 'required'
        ]);

        User::create($validated);

        return redirect('/users');

    });

    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });
});
