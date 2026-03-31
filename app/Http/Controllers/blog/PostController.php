<?php

namespace App\Http\Controllers\blog;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // liste des news (articles ou posts) en fonction du company
        
        $posts = isset(Auth::user()->company) ? Post::where('create_by',Auth::user()->company->id)->orderBy('created_at','DESC')->get() : null;
        
        return view('account.company.news.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if(!Auth::user()->company){
            return redirect()->route('co.overview')->with('error','Veuillez d\'abord remplir les informations de votre compagnie');
        }
        
        return view('account.company.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "title"=> "required|string",
            "thumbnail"=>"nullable|image|mimes:png,jpg|max:2048",
            "description"=>"required|string",
            "attach"=>"nullable|file|mimes:pdf|max:2048"
        ]);

        if($validator->fails()){
            return redirect()->back()->with($validator);
        }
        
        $path_thumbnail = "";
        $path_attach = "";

        if($request->hasFile('thumbnail')){
            $path_thumbnail = $request->file('thumbnail')->store('company/posts/thumbnails','public');
        }

        if($request->hasFile('attach')){
            $path_attach = $request->file('attach')->store('company/posts/attachs','public');
        }
        $company_id = Auth::user()->company->id;
        $save = Post::Create([
            "create_by"=> $company_id,
            "title"=>$request->title,
            "thumbnail"=>$path_thumbnail,
            "description"=>$request->description,
            "attach"=> $path_attach
        ]);

        if($save){
            return redirect()->route('co.posts')->with('success','Article enregistrer avec succès');
        }

        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //afficher un new
        $post = Post::findOrFail($id);



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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
