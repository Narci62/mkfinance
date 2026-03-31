<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Matricule;
use App\Models\User;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'account_type' => ['required', 'in:company,investor'],
        ], [
            'firstname.required' => 'Veuillez entrer votre prénom.',
            'firstname.string' => 'Le prénom doit être une chaîne de caractères.',
            'firstname.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
        
            'lastname.required' => 'Veuillez entrer votre nom.',
            'lastname.string' => 'Le nom doit être une chaîne de caractères.',
            'lastname.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        
            'email.required' => 'Veuillez entrer votre adresse e-mail.',
            'email.string' => 'L\'adresse e-mail doit être une chaîne de caractères.',
            'email.lowercase' => 'L\'adresse e-mail doit être en minuscules.',
            'email.email' => 'Veuillez saisir une adresse e-mail valide.',
            'email.max' => 'L\'adresse e-mail ne peut pas dépasser 255 caractères.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
        
            'password.required' => 'Veuillez entrer un mot de passer.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.password' => 'Le mot de passe doit répondre aux exigences de sécurité.',
        
            'account_type.required' => 'Veuillez selectionner votre objetif.',
            'account_type.in' => 'Veuillez choisir un objectif.',
        ]);
        //imatriculation
        $imat = new Matricule();

        do {
            $matricule = $imat->getImat();
        } while (User::where('matricule',$matricule)->exists());

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type,
            'matricule' => $matricule
        ]);

        event(new Registered($user));

        Auth::login($user);


        // Redirection based on account type
        if ($user->account_type == 'company') {
            return redirect()->route('co');
        }
        elseif($user->account_type == 'investor')
            return redirect()->route('in');
        else {
            return redirect()->route('admin');
        }

        // return redirect(route('dashboard', absolute: false));
    }
}
