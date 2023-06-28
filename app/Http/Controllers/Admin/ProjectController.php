<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Admin\Technology;
use App\Models\Admin\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
         
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // $request->validate(
        //     [
        //         'title' => 'required',
        //     ],
        //     [
        //         'title.required' => 'Il campo Title é richiesto',
        //     ]
        // );

        $form_data = $request->all();

        $slug = Project::generateSlug($request->title);

        $form_data['slug'] = $slug;

        if ($request->hasFile('cover_image')) {

            //Genere un path di dove verrà salvata l'immagine nel progetto
            $path = Storage::disk('public')->put('project_images', $request->cover_image);

            $form_data['cover_image'] = $path;

        }

        $newProject = new Project();
        $newProject->fill($form_data);
        $newProject->save();

        //oppure questa sintassi
        //$newProject = Project::create($form_data);

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

        toastr()->success('Hai creato un nuovo progetto!', 'Congrats');

        return redirect()->route('admin.project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Project $project)
    {
        // $request->validate(
        //     [
        //         'title' => 'required',
        //     ],
        //     [
        //         'title.required' => 'Il campo Title é richiesto',
        //     ]
        // );

        $form_data = $request->all();

        $slug = Project::generateSlug($request->title);

        $form_data['slug'] = $slug;

        if ($request->hasFile('cover_image')) {


            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            //Genere un path di dove verrà salvata l'immagine nel progetto
            $path = Storage::disk('public')->put('project_images', $request->cover_image);

            $form_data['cover_image'] = $path;
        }

        $project->update($form_data);

        //pusho le tecnologie nella tabella pivot
        $project->technologies()->sync($request->technologies);

        toastr()->success('Hai modificato il progetto selezionato!', 'Congrats');


        return redirect()->route('admin.project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        $project->technologies()->sync([]);

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }   
        
        $project->delete();

        toastr()->success('Hai cancellato il progetto selezionato!', 'Congrats');

        return redirect()->route('admin.project.index');
    }
}
