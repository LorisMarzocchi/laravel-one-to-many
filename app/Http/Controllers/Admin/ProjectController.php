<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    private $validation = [
        'title' => 'required|string|max:50',
        'url_image' => 'required|url|max:250',
        'description' => 'required|string',
        'languages' => 'required|string|max:50',
        'link_github' => 'required|url|max:150',
    ];
    private $validation_messages =[
        'required'    => 'il campo :attribute è obbligatorio',// per personalizzare il messaggio di errore
        'min'    => 'il campo :attribute deve avere :min carattri',
        'max'    => 'il campo :attribute deve avere :max carattri',
        'url'   => 'il campo è obbligatorio',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation, $this->validation_messages);
        // $request->validate([
        //     'title' => 'required|string|max:50',
        //     'url_image' => 'required|url|max:250',
        //     'description' => 'required|string',
        //     'languages' => 'required|string|max:50',
        //     'link_github' => 'required|url|max:150',

        // ],
        // [
        //     'required'    => 'il campo :attribute è obbligatorio',// per personalizzare il messaggio di errore
        //     'min'    => 'il campo :attribute deve avere :min carattri',
        //     'max'    => 'il campo :attribute deve avere :max carattri',
        //     'url'   => 'il campo è obbligatorio',
        // ]

    // );

        $data= $request->all();

        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->url_image = $data['url_image'];
        $newProject->description = $data['description'];
        $newProject->languages = $data['languages'];
        $newProject->link_github = $data['link_github'];
        $newProject->save();

        return to_route('admin.projects.show', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate($this->validation, $this->validation_messages);

        $data= $request->all();


        $project->title = $data['title'];
        $project->url_image = $data['url_image'];
        $project->description = $data['description'];
        $project->languages = $data['languages'];
        $project->link_github = $data['link_github'];
        $project->update();

        return to_route('admin.projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}
