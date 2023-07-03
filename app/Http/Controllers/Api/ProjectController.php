<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request){

		//$projects = Project::all();

		//oppure per avere anche le relazioni

		//$projects = Project::with('type','technologies')->get();

		//oppure per avere tot(3) elementi per pagina 

		// if ($request->has('type_id')) {

		// 	$projects = Project::with('type', 'technologies')->where('type_id', $request->type_id)->paginate(3);

		// } else {

		// 	$projects = Project::with('type', 'technologies')->paginate(3);

		// }

		$query = Project::with(['type', 'technologies']);

		//prima condizione per filtrare solo i progetti che hanno un tipo uguale a quello della request

		if ($request->has('type_id')) {
			$query->where('type_id', $request->type_id);
		}

		//seconda condizione per filtrare solo i progetti che hanno una tecnologia uguale a quello della request

		if ($request->has('technologies_ids')) {

			$technologiesIds = explode(',', $request->technologies_ids);

			$query->whereHas('technologies', function ($query) use ($technologiesIds) {
				$query->whereIn('id', $technologiesIds);
			});
		}

		$projects = $query->paginate(3);

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
