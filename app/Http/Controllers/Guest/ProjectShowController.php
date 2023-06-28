<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;


class ProjectShowController extends Controller
{
    public function show($id){

        $project = Project::findOrFail($id);

        // $project = project::where('slug', $slug)->firstOrFail();

        return view('guest.show', compact('project'));
    }
}
