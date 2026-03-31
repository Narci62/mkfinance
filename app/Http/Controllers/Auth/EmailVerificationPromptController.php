<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $statusMessage = 'Votre adresse e-mail a été vérifiée avec succès !';

        if ($request->user()->hasVerifiedEmail()) {
            // Redirection based on account type
            if ($request->user()->account_type == 'company') {
                return redirect()->intended(route('co').'?verified=1')->with('success', $statusMessage);
            } else {
                return redirect()->intended(route('in').'?verified=1')->with('success', $statusMessage);
            }
        }

        return view('auth.verify-email');
    }
}
