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

	//$projects = Project::with('type','technologies')->get();

//oppure per avere tot(3) elementi per pagina 

	$projects = Project::with('type', 'technologies')->paginate(3);

	return response()->json([
		'success' => true,
        'projects' => $projects
		]);
	}

	public function show($slug)
	{
		$projects = Project::with('type', 'technologies')->where('slug', $slug)->first();

		if ($projects) {
			return response()->json([
				'success' => true,
				'project' => $projects
			]);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'non ci sono projects'
			])->setStatusCode(404);
		}
	}

}
