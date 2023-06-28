<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
	 //$projects = Project::all();

//oppure per avere anche le relazioni

$projects = Project::with('type','technologies')->get();

//oppure per avere tot(3) elementi per pagina 

	//$projects = Project::with('category','tags')->paginate(3);

	return response()->json([
		'success' => true,
        'projects' => $projects
	]);
}
}
