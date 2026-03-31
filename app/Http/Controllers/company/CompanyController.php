<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Services\Matricule;
use App\Models\Post;
use App\Models\Company;
use App\Models\Project;
use App\Models\RoiPlan;
use App\Models\FundingPlan;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteUri;
use App\Services\WalletService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $company = $user->company ?? "";
        $complete_account = false;

        if (empty($user->firstname) or empty($user->lastname) or empty($user->phone_number) or empty($user->email) or empty($user->avatar) or empty($user->id_type) or empty($user->email_verified_at)) {
            $complete_account = true;
        }
            //créer le portefeuille 
            $wallet = new WalletService($user);
            $wallet->createwallet();
        
        return view('account.company.index', compact('company', 'user', 'complete_account'));
    }

    /**
     * Display a listing of the resource.
     */
    public function overview()
    {
        $user = Auth::user();
        // il faut soumettre les informations de son entreprise avant d'acceder à l'espace de gestion
        /*if (!$user->company || $user->wizard_step < 3) {
            return redirect()->route('wizard.config1')->with('error','Veuillez remplir les informations de votre entreprise');
        }*/

        $company = $user?->company;
      //  dd($company);
        $project = $company?->project;
        //dernier investisseur
        $latest_investor = $project != null ? $project->investment()->latest('created_at')->first() : ""; //->latest('created_at')->first()?->investor()->first();
        //nombre d'article
        $count_new = $company != null ? Post::where('create_by',$company->id)->count() : "";
        //avis moyen
        $average_avis =$company?->avis()->avg('count_star') ?? 0 ;
        //completer le profil
        $complete_account = "";
        if (empty($user->firstname) or empty($user->lastname) or empty($user->phone_number) or empty($user->email) or empty($user->avatar) or empty($user->id_type) or empty($user->email_verified_at)) {
            $complete_account = true;
        }
        return view('account.company.project-overview', compact('company', 'user', 'project','count_new','latest_investor','average_avis','complete_account'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        //renvoye sur la page d'accueil si les informations de l'entreprise ne sont pas renseigner
        if ($user->company) {
            $project_step = $user->company->project_step;
        } else {
            return redirect()->route('wizard.config1')->with('error','Veuillez d\'abord remplir les informations de votre entreprise');
        }
        /**
         * si le projet est deja soumis on remplira les champs avec les informations disponible
         * l'accès aux formulaires (plan d'investissement et retour sur investissement) néccéssite la soumission du project à l'étape un
         */


        $project = Project::where('project_of', $user->company->id)->first() ?? "";

        if (Route::is('co.project1')) {
            return view('account.company.project.index', compact('project_step', 'user', 'project'));
        }
        if (Route::is('co.project2')) {
            if ($project == "") {
                return view('account.company.project.index', compact('project_step', 'user', 'project'));
            } else {
                $plan = $project->fundingplan ?? "";
                return view('account.company.project.plan', compact('project_step', 'user', 'plan'));
            }
        }
        if (Route::is('co.project3')) {
            if ($project == "") {
                return view('account.company.project.index', compact('project_step', 'user', 'project'));
            } else {
                $roi_plan = $project->roi_plan ?? "";
                return view('account.company.project.roi', compact('project_step', 'user', 'roi_plan'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeProject1(Request $request)
    {
        // dd($request); 
        //validation les données si le projet n'existe pas 
        $validator = Validator::make($request->all(), [
            'titled' => 'required|string',
            'description' => 'required|string',
            'totalFundedNeeded' => 'required|numeric',
            'InvestmentAmountfix' => 'required|numeric',
            'amountToStart' => 'required|numeric',
            'featured_image' => 'required|image|max:2048',
            'makeStudy' => 'required|file|mimes:pdf|max:2048',
        ], [
            'description.required' => "Veuillez decrire votre projet",
            'description.string' => "Veuillez entrer des chaines de caractère"
        ]);


        $project = Project::where('project_of', Auth::id())->first();
        if ($project) {

            //validation les données si le projet existe 
            $validator = Validator::make($request->all(), [
                'titled' => 'required|string',
                'description' => 'required|string',
                'totalFundedNeeded' => 'required|numeric',
                'InvestmentAmountfix' => 'required|numeric',
                'amountToStart' => 'required|numeric',
                'featured_image' => 'required|image|max:2048',
                'makeStudy' => 'nullable|file|mimes:pdf|max:2048',
            ], [
                'description.required' => "Veuillez decrire votre projet",
                'description.string' => "Veuillez entrer des chaines de caractère"
            ]);

            //envoyer les erreurs à l'interface
            if ($validator->fails()) {
                return redirect()->route('co.project1')
                    ->withErrors($validator)
                    ->withInput();
            }

            //recuperer le numero matricule
            $matricule = $project->imat;
            //traiter les fichiers
            if ($request->hasFile('makeStudy')) {
                if ($project->makeStudy) {
                    Storage::disk('public')->delete($project->makeStudy);
                }
                $makeStudypath = $request->file('makeStudy')->store('company/project/makeStudy', 'public');
            } else {
                $makeStudypath = $project->makeStudy;
            }

            if ($request->hasFile('featured_image')) {
                if ($project->featured_image) {
                    Storage::disk('public')->delete($project->featured_image);
                }
                $feature_imagepath = $request->file('featured_image')->store('company/project/featured_images', 'public');
            } else {
                $feature_imagepath = $project->featured_image;
            }
        } else {

            //envoyer les erreur au front
            if ($validator->fails()) {
                return redirect()->route('co.project1')
                    ->withErrors($validator)
                    ->withInput();
            }

            $makeStudypath = $request->file('makeStudy')->store('company/project/makeStudy', 'public');
            $feature_imagepath = $request->file('featured_image')->store('company/project/featured_images', 'public');

            //generer le numero matricule
            $imat = new Matricule(10);

            do {
                $imatr = $imat->getImat();
                $matricule = "PROJ-" . $imatr;
            } while (Project::where('imat', $matricule)->exists());
        }

        $company = Auth::user()->company->id;


        $project = Project::updateOrCreate([
            'imat' => $matricule
        ], [
            'imat' => $matricule,
            'titled' => $request->titled,
            'description' => $request->description,
            'totalFundedNeeded' => $request->totalFundedNeeded,
            'InvestmentAmountfix' => $request->InvestmentAmountfix,
            'amountToStart' => $request->amountToStart,
            'featured_image' => $feature_imagepath,
            'makeStudy' => $makeStudypath,
            'project_of' => $company
        ]);

        if ($project) {
            $company = Company::where('created_by', Auth::id())->first();
            $company->update(['project_step' => 2]);

            return redirect()->route('co.project2')->with('success', 'Effectuée!!! Veuillez passer à l\'étape suivante');
        }
    }

    public function storeProject2(Request $request)
    {
        //validation des données si le plan d'investissement n'est pas encore renseigné
        $validator = Validator::make($request->all(), [
            'fundUsage' => 'required|file|mimes:pdf|max:2048',
            'fundingSchedule' => 'required|file|mimes:pdf|max:2048'
        ], [
            'fundUsage.required' => "Veuillez fournir le document demandé",
            'fundingSchedule.required' => "Veuillez fournir le document demandé"
        ]);

        //traiter les fichiers
        $project = Project::where('project_of', Auth::user()->company->id)->first();
     
        //verifier si le plan d'investissement est deja renseigné
        if ($project->fundingplan) {

            //validation des données si le plan d'investissement est déjà renseigné
            $validator = Validator::make($request->all(), [
                'fundUsage' => 'nullable|file|mimes:pdf|max:2048',
                'fundingSchedule' => 'nullable|file|mimes:pdf|max:2048'
            ], [
                'fundUsage.file' => "Veuillez fournir un document",
                'fundingSchedule.file' => "Veuillez fournir un document"
            ]);

            // envoyer les erreurs à l'interface
            if ($validator->fails()) {
                return redirect()->route('co.project2')
                    ->withErrors($validator)
                    ->withInput();
            }

            $fundingplan = $project->fundingplan;
            if ($request->hasFile('fundUsage')) {
                if ($fundingplan->fundUsage) {
                    Storage::disk('public')->delete($fundingplan->fundUsage);
                }
                $Usagepath = $request->file('fundUsage')->store('company/project/fundUsage', 'public');
            } else {
                $Usagepath = $fundingplan->fundUsage;
            }

            if ($request->hasFile('fundingSchedule')) {
                if ($fundingplan->fundingSchedule) {
                    Storage::disk('public')->delete($fundingplan->fundingSchedule);
                }
                $Schedulepath = $request->file('fundingSchedule')->store('company/project/fundingSchedule', 'public');
            } else {
                $Schedulepath = $fundingplan->fundingSchedule;
            }
        } else {

            // envoyer les erreurs à l'interface
            if ($validator->fails()) {
                return redirect()->route('co.project2')
                    ->withErrors($validator)
                    ->withInput();
            }

            $Usagepath = $request->file('fundUsage')->store('company/project/fundUsage', 'public');
            $Schedulepath = $request->file('fundingSchedule')->store('company/project/fundingSchedule', 'public');
        }


        $save = FundingPlan::updateOrCreate([
            'reference_project' => $project->id
        ], [
            'fundUsage' => $Usagepath,
            'fundingSchedule' => $Schedulepath,
            'reference_project' => $project->id
        ]);

        if ($save) {
            $company = Company::where('created_by', Auth::id())->first();
            $company->update(['project_step' => 3]);

            return redirect()->route('co.project3')->with('success', 'Effectuée!!! Veuillez passer à l\'étape suivante');
        }
    }

    public function storeProject3(Request $request)
    {
        //validation des données si les données liées au retour sur investissement ne sont pas renseignées
        $validator = Validator::make($request->all(), [
            'expectROI' => 'required',
            'paymentFrequency' => 'required|numeric',
            'paymentSchedule' => 'required|file|mimes:pdf|max:2048',
            'totalDuration' => 'required|numeric',
            'adjusteSchedule' => 'required|file|mimes:pdf|max:2048',
        ], [
            'expectROI.required' => "Veuillez renseigner le rendement attentu sur l'investissement"
        ]);



        //traiter les fichiers
        $project = Project::where('project_of', Auth::user()->company->id)->first();
        $roi_plan = $project->roi_plan;
        if ($roi_plan) {
            //validation des données si les données liées au retour sur investissement sont déjà renseignées
            $validator = Validator::make($request->all(), [
                'expectROI' => 'required',
                'paymentFrequency' => 'required|numeric',
                'paymentSchedule' => 'nullable|file|mimes:pdf|max:2048',
                'totalDuration' => 'required|numeric',
                'adjusteSchedule' => 'nullable|file|mimes:pdf|max:2048',
            ], [
                'expectROI.required' => "Veuillez renseigner le rendement attentu sur l'investissement"
            ]);
            // envoyer les erreurs à l'interface
            if ($validator->fails()) {
                return redirect()->route('co.project3')
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->hasFile('makeStudy')) {
                if ($roi_plan->paymentSchedule) {
                    Storage::disk('public')->delete($roi_plan->paymentSchedule);
                }
                $paymentSchedulepath = $request->file('paymentSchedule')->store('company/project/paymentSchedule', 'public');
            } else {
                $paymentSchedulepath = $roi_plan->paymentSchedule;
            }

            if ($request->hasFile('makeStudy')) {
                if ($roi_plan and $roi_plan->adjusteSchedule) {
                    Storage::disk('public')->delete($roi_plan->adjusteSchedule);
                }
                $adjusteSchedulepath = $request->file('adjusteSchedule')->store('company/project/adjusteSchedule', 'public');
            } else {
                $adjusteSchedulepath = $roi_plan->adjusteSchedule;
            }
        } else {

            // envoyer les erreurs à l'interface
            if ($validator->fails()) {
                return redirect()->route('co.project3')
                    ->withErrors($validator)
                    ->withInput();
            }


            $paymentSchedulepath = $request->file('paymentSchedule')->store('company/project/paymentSchedule', 'public');
            $adjusteSchedulepath = $request->file('adjusteSchedule')->store('company/project/adjusteSchedule', 'public');
        }

        $save = RoiPlan::updateOrCreate([
            'reference_project' => $project->id
        ], [
            'expectROI' => $request->expectROI,
            'paymentFrequency' => $request->paymentFrequency,
            'paymentSchedule' => $paymentSchedulepath,
            'totalDuration' => $request->totalDuration,
            'adjusteSchedule' => $adjusteSchedulepath,
            'reference_project' => $project->id
        ]);

        if ($save) {
            $company = Company::where('created_by', Auth::id())->first();
            $company->update(['project_step' => 4]);

            return redirect()->route('co.overview')->with('success', 'Effectuée!!! Votre projet est soumis pour validation');
        }
    }

    //investments

    public function investors(){
        $user = Auth::user();
        // il faut soumettre les informations de son entreprise avant d'acceder à l'espace de gestion
        if (!$user->company || $user->wizard_step < 3) {
            return redirect()->route('wizard.config1')->with('error','Veuillez remplir les informations de votre entreprise');
        }

        $company = $user->company;
        $project = $company->project;
        //dernier investisseur
        $investors = $project->investment()->get(); //->latest('created_at')->first()?->investor()->first();
        //nombre d'article
        $count_new = Post::where('create_by',$company->id)->count();
        return view('account.company.investment.index', compact('company', 'user', 'project','count_new','investors'));       
    }

    public function investor($id){

    }

    //wallet
    public function wallets(){
        $user = Auth::user();
        // il faut soumettre les informations de son entreprise avant d'acceder à l'espace de gestion
        if (!$user->company || $user->wizard_step < 3) {
            return redirect()->route('wizard.config1')->with('error','Veuillez remplir les informations de votre entreprise');
        }

        $company = $user->company;
        $project = $company->project;
        //portefeuille
        $wallet = new WalletService($user);
        $monwallet = $wallet->getwallet();
        //operations
        $operations = Operation::where('holder',$user->id)->get();
        //dernier investisseur
        $latest_investor = ""; //->latest('created_at')->first()?->investor()->first();
        //nombre d'article
        $count_new = Post::where('create_by',$company->id)->count();
        return view('account.company.wallet', compact('company', 'user', 'project','count_new','latest_investor','monwallet','operations'));       
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
