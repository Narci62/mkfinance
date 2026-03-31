<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Facades\Validator;

class StartCompanyController extends Controller
{
    /**
     * Display step 1 of the wizard
     */
    public function wizardConfig()
    {
        $user = Auth::user();
        $step_config = $user->wizard_step;
        // il faut remplir et valider toute les information personnelle avant de soumettre celles de son entreprise
        if (empty($user->firstname) or empty($user->lastname) or empty($user->phone_number) or empty($user->email) or empty($user->avatar) or empty($user->id_type) or empty($user->email_verified_at)) {
            return redirect()->route('co.profile')->with('error','Veuillez remplir vos informations personnelles avant de soumettre celles de votre entreprise');
        }

        if($step_config > 3){
            return redirect()->route('co');
        }
        
        if($step_config <= 2){

            $sectors = Sector::All();
        }else{
            $sectors = '';
        }

        return view('account.company.start.index', compact('step_config', 'sectors'));
    }

     /**
     * Store step 1 of the wizard
     */
    public function storeWizardConfig1(Request $request)
    {
        // Valider les données du formulaire
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:100',
            'company_sector' => 'required|string|max:100',
            'company_other_sector' => 'nullable|string|max:100',
            'company_overview_intro' => 'required|string|max:1000',
            'company_staff_number' => 'required|string|max:50',
            'company_yearly_income' => 'required|string|max:50',
        ]);

        

        // Si la validation échoue, rediriger avec des erreurs
        if ($validator->fails()) {
            return redirect()->route('wizard.config1')
                ->withErrors($validator)
                ->withInput();
        }

        // Obtenir l'utilisateur authentifié
        $user = User::find(Auth::user()->id);

        // Déterminer si l'utilisateur a choisi "other" comme secteur
        $sector = $request->input('company_sector');
        $otherSector = $request->input('company_other_sector');
        
        // Si l'utilisateur a choisi "other", utiliser la valeur du champ "other_sector"
        if ($sector === 'other' && $otherSector) {
            // Créer ou mettre à jour l'entreprise associée à l'utilisateur
            $company = Company::updateOrCreate(
                ['created_by' => $user->id],
                [
                    'name' => $request->input('company_name'),
                    'sector_id' => 1,
                    'other_sector' => $otherSector,
                    'overview_description' => $request->input('company_overview_intro'),
                    'staff_number' => $request->input('company_staff_number'),
                    'yearly_income' => $request->input('company_yearly_income'),
                ]
            );
        }else{
            // Sinon, utiliser le secteur choisi dans le champ "company_sector"
            $company = Company::updateOrCreate(
                ['created_by' => $user->id],
                [
                    'name' => $request->input('company_name'),
                    'sector_id' => $sector,
                    'overview_description' => $request->input('company_overview_intro'),
                    'staff_number' => $request->input('company_staff_number'),
                    'yearly_income' => $request->input('company_yearly_income'),
                ]
            );
        }

        

        if($company){
            // Mettre à jour l'étape du wizard pour l'utilisateur (si vous avez un champ wizard_step dans users)
            $updatedWizard = $user->update(['wizard_step' => 2]);
        }

        // Rediriger vers l'étape suivante
        return redirect()->route('wizard.config2')->with('success', 'Etape 1 passée avec succès');
    }

     /**
     * Store step 2 of the wizard
     */
    public function storeWizardConfig2(Request $request)
    {
        // Valider les données du formulaire
        $validator = Validator::make($request->all(), [
            'company_email' => 'required|email',
            'company_phone_number' => 'required|string',
            'company_website' => 'required|url',
            'company_adresse' => 'required|string|max:100'
        ]);
        
        // Si la validation échoue, rediriger avec des erreurs
        if ($validator->fails()) {
            return redirect()->route('wizard.config2')
                ->withErrors($validator)
                ->withInput();
        }

        // Obtenir l'utilisateur authentifié
        $user = User::find(Auth::user()->id);

        $onGoingCompany = $user->company;

       //  dd($validator);
                $onGoingCompany->company_email = $request->input('company_email');
                $onGoingCompany->company_phone_number = $request->input('company_phone_number');
                $onGoingCompany->company_website = $request->input('company_website');
                $onGoingCompany->company_adresse = $request->input('company_adresse');
        $onGoingCompany->save();

       // dd($onGoingCompany);

        if($onGoingCompany){
            // Mettre à jour l'étape du wizard pour l'utilisateur (si vous avez un champ wizard_step dans users)
            $updatedWizard = $user->update(['wizard_step' => 3]);
        }

        // Rediriger vers l'étape suivante
        return redirect()->route('wizard.config3')->with('success', 'Etape 2 passée avec succès');
    }

    /**
     * Store step 3 of the wizard
     */
    public function storeWizardConfig3(Request $request)
    {
        
        // Valider les données du formulaire
        $validator = Validator::make($request->all(), [
            'company_logo' => 'required|image|max:2048',
            'company_rccm' => 'required|mimes:pdf|max:2048',
            'company_ifu' => 'required|mimes:pdf|max:2048',
            'company_atf' => 'required|mimes:pdf|max:2048'
        ]);

        // Si la validation échoue, rediriger avec des erreurs
        if ($validator->fails()) {
            return redirect()->route('wizard.config3')
                ->withErrors($validator)
                ->withInput();
        }

        // Obtenir l'utilisateur authentifié
        $user = User::find(Auth::user()->id);
        $onGoingCompany = $user->company;
        //traiter le logo
        if ($request->hasFile('company_logo')) {
            if ($onGoingCompany->main_logo) {
                FacadesStorage::disk('public')->delete($onGoingCompany->main_logo);
            }
            $avatarPath = $request->file('company_logo')->store('company/logos', 'public');
        } else {
            $avatarPath = $onGoingCompany->main_logo;
        }

        //traiter le rccm
        if ($request->hasFile('company_rccm')) {
            if ($onGoingCompany->main_rccm) {
                FacadesStorage::disk('public')->delete($onGoingCompany->main_rccm);
            }
            $rccmPath = $request->file('company_rccm')->store('company/rccms', 'public');
        } else {
            $rccmPath = $onGoingCompany->main_rccm;
        }

        //traiter ifu
        if ($request->hasFile('company_ifu')) {
            if ($onGoingCompany->main_ifu) {
                FacadesStorage::disk('public')->delete($onGoingCompany->main_ifu);
            }
            $ifuPath = $request->file('company_ifu')->store('company/ifus', 'public');
        } else {
            $ifuPath = $onGoingCompany->main_ifu;
        }

        //traite le atf
        if ($request->hasFile('company_atf')) {
            if ($onGoingCompany->main_atf) {
                FacadesStorage::disk('public')->delete($onGoingCompany->main_atf);
            }
            $atfPath = $request->file('company_atf')->store('company/atfs', 'public');
        } else {
            $atfPath = $onGoingCompany->main_atf;
        }
        $data = [
                'main_logo' => $avatarPath,
                'main_rccm' => $rccmPath,
                'main_ifu' => $ifuPath,
                'main_atf' => $atfPath,
        ];
        

        
               $onGoingCompany ->main_logo = $avatarPath;
                $onGoingCompany ->main_rccm = $rccmPath;
                $onGoingCompany ->main_ifu = $ifuPath;
                $onGoingCompany ->main_atf = $atfPath;
                $onGoingCompany ->status = 1;
                $onGoingCompany ->project_step = 1;

                $onGoingCompany ->save();
           
        
        if($onGoingCompany){
            // Mettre à jour l'étape du wizard pour l'utilisateur (si vous avez un champ wizard_step dans users)
            $updatedWizard = $user->update(['wizard_step' => 4]);
        }

        // Rediriger vers l'étape suivante
        return redirect()->route('wizard.config3')->with('success', 'Soumission éffectuée avec succès. Vous pouvez rediger votre projet à présent&');
    }

}
