<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Controllers\Controller;
use App\Jobs\welcome_to_our_store;
use App\Mail\welcomeHome;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


public function store(StoreUserRequest $request)
{
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        welcome_to_our_store::dispatch($user);
        event(new Registered($user));
        Auth::login($user);
        // توجيه حسب الدور
        if ($user->role === 'customer') {
         return redirect()->route('store');
        }
        return redirect(route('dashboard', absolute: false));
    }
}
