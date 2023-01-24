<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
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
        $projects = Project::paginate(5);
        //devuelve una vista y le pasamos la variable projects
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $title = _('Crear proyecto');
        $textButton= _('Crear proyecto');
        $route = route('projects.store');

        return view('projects.form', compact('project', 'title', 'textButton', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $validated=$request->safe()->only(['name', 'description', 'image', 'category_id']);
        $imageName = time().'.'.$request->image->extension();
        if($request->image->getMimeType() == 'application/pdf'){
            $request->image->move(public_path('pdf'), $imageName);
        }else{
            $request->image->move(public_path('images'), $imageName);
        }
        $validated['image'] = $imageName;

        Project::create($validated);
        return redirect(route('projects.index'))
            ->with('success',_("¡Proyecto creado!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $title = _('Editar proyecto');
        $textButton= _('Actualizar');
        $route = route('projects.update', ["project" =>$project]);

        return view('projects.form', compact('title', 'textButton', "route", "project"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $validated=$request->safe()->only(['name', 'description', 'image', 'category_id']);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            if($request->image->getMimeType() == 'application/pdf'){
                $request->image->move(public_path('pdf'), $imageName);
            }else{
                $request->image->move(public_path('images'), $imageName);
            }
            $validated['image'] = $imageName;
        }

        $project->update($validated);

        return redirect(route('projects.index'))
            ->with('success', _('¡Proyecto actualizado!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        Storage::disk('images')->delete($project->image);
        $project->delete();
        return back()->with('success', _('¡Proyecto eliminado!'));
    }
}
