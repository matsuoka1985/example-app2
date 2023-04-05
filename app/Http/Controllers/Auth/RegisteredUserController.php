<?php

namespace App\Http\Controllers\Auth;

// 以下のクラスとinterfaceをuseで追加。
use App\Mail\NewUserIntroduction;
use Illuminate\Contracts\Mail\Mailer;
//
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    //引数にMailer型の＄mailer追加。
     public function store(Request $request,Mailer $mailer): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($newUser));

        Auth::login($newUser);

        //メール送信処理追加。
        // $mailer->to('test@example.com')
        //     ->send(new NewUserIntroduction());

        $allUser=User::get();
        foreach($allUser as $user){

                $mailer->to($user->email)
                    ->send(new NewUserIntroduction($user,$newUser));
        }

        return redirect(RouteServiceProvider::HOME);
    }
}