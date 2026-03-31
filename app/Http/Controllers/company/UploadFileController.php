<?php

namespace App\Http\Controllers\company;

use App\Models\Blob;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadFileController extends Controller
{
    public function index(Request $request)
    {
        
        // Retour de l'URL publique du fichier
        return response()->json(['location' => $request->file('file') ]);
    }

}
