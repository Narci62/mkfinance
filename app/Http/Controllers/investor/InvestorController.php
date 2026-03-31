<?php

namespace App\Http\Controllers\investor;

use App\Events\InvestmentEvent;
use App\Models\Project;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Services\WalletService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\InvestmentRequestNotification;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $complete_account = false;
        if (empty($user->firstname) or empty($user->lastname) or empty($user->phone_number) or empty($user->email) or empty($user->avatar) or empty($user->id_type) or empty($user->email_verified_at)) {
            $complete_account = true;
        }
        //créer le portefeuille 
        $wallet = new WalletService($user);
        $wallet->createwallet();
        $investment = Investment::where('investor', $user->id)->orderBy('created_at', 'DESC')->first();
        return view('account.investor.index', compact('complete_account', 'investment','wallet'));
    }

    /**
     * Investment lists
     */
    public function investments()
    {
        $user = Auth::user();
        $complete_account = false;
        if (empty($user->firstname) or empty($user->lastname) or empty($user->phone_number) or empty($user->email) or empty($user->avatar) or empty($user->id_type) or empty($user->email_verified_at)) {
            $complete_account = true;
        }
        $investments = Investment::where('investor', $user->id)->orderBy('created_at', 'DESC')->get();

        return view('account.investor.investment', compact('investments', 'complete_account'));
    }

    /**
     * wallet
     */
    public function wallet()
    {

        return view('account.investor.wallet');
    }

    public function favorite()
    {

        return view('account.investor.favorite');
    }

    /**
     * Start investment
     */
    public function invest($id)
    {
        $project = Project::where('imat', $id)->first();
        if ($project) {
            return view('account.investor.startInvestment', compact('project'));
        }

        return redirect()->back();
    }

    /**
     * Save investment
     */
    public function storeInvest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project' => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with($validator);
        }

        $project = Project::where('imat', $request->project)->first();
        $investor = Auth::user();

        $save = Investment::create([
            'investor' => $investor->id,
            'reference_project' => $project->id,
            'amount' => $project->InvestmentAmountfix
        ]);

        if ($save) {
            event(new InvestmentEvent(Auth::user(), $save));
            return redirect()->route('in.investments')->with('success', 'Investissment éffectué avec succès');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
