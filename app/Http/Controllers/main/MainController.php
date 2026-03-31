<?php

namespace App\Http\Controllers\main;

use App\Models\Avis;
use App\Models\Post;
use App\Models\Sector;
use App\Models\Company;
use App\Models\Project;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FundingPlan;
use App\Models\Investment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
    /**
     * Display home
     */
    public function home()
    {
        $projects = $this->getProject(6);

        return view('main.index',compact('projects'));
    }

    /**
     * Display about
     */
    public function about()
    {
        return view('main.about');
    }

    /**
     * Display faqs
     */
    public function faqs()
    {
        return view('main.faqs');
    }

    /**
     * Display contact
     */
    public function contact()
    {
        return view('main.contact');
    }

    /**
     * Display blog
     */
    public function blog()
    {
        return view('main.blog');
    }

    /**
     * Display howToInvest
     */
    public function howToInvest()
    {
        return view('main.how-to-invest');
    }

     /**
     * Display whyInvest
     */
    public function whyInvest()
    {
        return view('main.why-invest');
    }

     /**
     * Display juridique
     */
    public function juridique()
    {
        return view('main.juridique');
    }

     /**
     * Display mission
     */
    public function mission()
    {
        return view('main.mission');
    }
     /**
     * Display projects
     */
    public function projects()
    {
        $projects = $this->getProject();
        return view('main.projects',compact('projects'));
    }

    public function viewsProject($id){
       // $data = [];
        $project = Project::where('imat',$id)->first();
        //domaine d'activité
        $sector = $project->company->sector_id == 1 ? $project->company->other_sector  : Sector::find($project->company->sector_id)->name;
        //project ayant le même d'activité
        $similars = Company::where('sector_id',$project->company->sector_id)->whereNot('id',$project->company->id)->with('project')->get();
        
        //recuperation des news et avis
        $news = Post::where('create_by',$project->company->id)->orderBy('created_at','DESC')->get();
        $avis = Avis::where('companie_id',$project->company->id)->get();

        

        if($project){

            return view('main.project-details',compact('project','sector','similars','news','avis'));
        }
        else{
            return view('errors.404');
        }
    }

    //send avis
    public function avissent(Request $request){
        
        $request->validate([
            'star' => 'required|min:1|max:5',
            'message'=>'required',
            'company'=>['required',Rule::exists('companies','id')]
        ]);

        $star = min($request->star,5);

        $save = Avis::create([
            'count_star' => $star,
            'message'=> $request->message,
            'sender' => Auth::id(),
            'companie_id' => $request->company
        ]);

        if($save){
            return redirect()->back()->with('succes','Avis enregistré avec succes');
        }
    }

    

    /**
     * get project lists
     */
    private function getProject($limit=0){
        if($limit == 0 ){
            $projects = Project::whereHas('company',function($company){
                $company->where('project_step',4);
            })->orderBy('created_at','DESC')->get();
        }
        else{
            $projects = Project::whereHas('company',function($company){
                $company->where('project_step',4);
            })->orderBy('created_at','DESC')->limit($limit)->get();
        }
        $projects->each(function($query){
            $query->sector = $query->company->sector_id == 1 ? $query->company->other_sector  : Sector::find($query->company->sector_id)->name;
        });

        return $projects;
    }
}
