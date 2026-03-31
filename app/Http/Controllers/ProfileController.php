<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function editProfile(Request $request): View
    {
        if (Auth::user()->account_type == 'company') {

            return view('account.company.profile.edit', [
                'user' => $request->user(),
            ]);
        }

        if (Auth::user()->account_type == 'investor') {

            return view('account.investor.profile.edit', [
                'user' => $request->user(),
            ]);
        }
    }

    /**
     * Display the user's profile form.
     */
    public function editPreferences(Request $request): View
    {
        if (Auth::user()->account_type == 'company') {

            return view('account.company.profile.preferences', [
                'user' => $request->user(),
            ]);
        }

        if (Auth::user()->account_type == 'investor') {

            return view('account.investor.profile.preferences', [
                'user' => $request->user(),
            ]);
        }
    }

    /**
     * Display the user's profile form.
     */
    public function editSecurity(Request $request): View
    {
        
        if (Auth::user()->account_type == 'company') {

            return view('account.company.profile.security', [
                'user' => $request->user(),
            ]);
        }

        if (Auth::user()->account_type == 'investor') {

            return view('account.investor.profile.security', [
                'user' => $request->user(),
            ]);
        }
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request, User $user): RedirectResponse
    {
        $user = User::find(Auth::user()->id);

        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            //  $avatarFolder = now()->format('Y-m-d');
            $path = "uploads/avatars";
            $avatarPath = $request->file('avatar')->store($path, 'public');
        } else {
            $avatarPath = $user->avatar;
        }

        $user->update(['avatar' => $avatarPath]);

        if (Auth::user()->account_type == 'company') {
            return Redirect::route('co.profile')->with('success', 'Photo de profil mis à jour');
        }

        if (Auth::user()->account_type == 'investor') {
            return Redirect::route('in.profile')->with('success', 'Photo de profil mis à jour');
        }
    }

    /**
     * Update the user's personnal infos.
     */
    public function updatePerso(Request $request, User $user): RedirectResponse
    {
        $user = User::find(Auth::user()->id);
        
        $request->validate([
            'phone_number' => ['nullable', 'string', 'max:30'],
        ]);

        $user->update([
            
            'phone_number' => $request->phone_number,
        ]);

        if (Auth::user()->account_type == 'company') {
            return Redirect::route('co.profile')->with('success', 'Informations personnelles mis à jour');
        }

        if (Auth::user()->account_type == 'investor') {
            return Redirect::route('in.profile')->with('success', 'Informations personnelles mis à jour');
        }
    }

    /**
     * Update the user's ID.
     */
    public function updateID(Request $request, User $user): RedirectResponse
    {
        $user = User::find(Auth::user()->id);

        $request->validate([
            'id_type' => ['required', 'string', 'max:255'],
            'id_document' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'id_exp' => ['required', 'date', 'after:today'],
        ]);

        if ($request->hasFile('id_document')) {
            if ($user->id_document) {
                Storage::disk('public')->delete($user->id_document);
            }

            $idDocumentFolder = now()->format('Y-m-d');
            $docPath = $request->file('id_document')->store("uploads/documents/users/{$idDocumentFolder}", 'public');
        } else {
            $docPath = $user->id_document;
        }

        // $user->update([ 'id_document' => $docPath]);

        $user->update([
            'id_type' => $request->id_type,
            'id_document' => $docPath,
            'id_document_exp' => $request->id_exp,
        ]);

        if (Auth::user()->account_type == 'company') {
            return Redirect::route('co.profile')->with('success', 'Document uploadé')->with('file', $docPath);
        }

        if (Auth::user()->account_type == 'investor') {
            return Redirect::route('in.profile')->with('success', 'Document uploadé')->with('file', $docPath);
        }
    }

    /**
     * Delete the user's account request.
     */
    public function deleteAccount(Request $request, User $user): RedirectResponse
    {

        $user = User::find(Auth::id());
        
        if ($user->account_del == 0) {
            $user->account_del = 1;
            //dd($user);
            $user->save();
        }
        if ($user->account_type == "company") {
            return redirect()->route('co.security')->with('success', 'Demande de suppression éffectué avec succès');
        } else {
            return redirect()->route('in.profile')->with('success', 'Demande de suppression éffectué avec succès');
        }
    }

    /**
     * Cancel of Deleting the user's.
     */
    public function canceldeleteAccount(Request $request): RedirectResponse
    {
        $user = User::find(Auth::id());
        
        if ($user->account_type == "company") {
            if ($user->account_del == 1) {
                $user->update([
                    'account_del' => 0
                ]);
                return redirect()->route('co.security')->with('success', 'Suppression de compte annulée avec succès');
            }
        } else {
            if ($user->account_del == 1) {
                $user->update([
                    'account_del' => 0
                ]);
                return redirect()->route('in.profile')->with('success', 'Suppression de compte annulée avec succès');
            }
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
