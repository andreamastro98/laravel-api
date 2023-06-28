<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;


class ProjectPageController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('guest.projects', compact('projects'));
    }
}

