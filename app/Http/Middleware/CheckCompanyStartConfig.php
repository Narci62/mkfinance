<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyStartConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Vérifiez si l'utilisateur est une entreprise
        if ($user->account_type === 'company') {
            // Récupérez l'entreprise associée à l'utilisateur
            $company = $user->company;

            if(!$company){
                // Redirigez vers l'étape 1 du wizard
                return redirect()->route('wizard.config1');
            }
            
            // Vérifiez le statut de l'entreprise
            if ($company && $company->status < 1) {
                // Redirigez vers la prochaine étape du wizard en fonction de la progression
                return redirect()->route('wizard.config' . $user->wizard_step);
            }
        }

        return $next($request);
    }
}
