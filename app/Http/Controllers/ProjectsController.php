<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        $atrributes = request()->validate([
            'title' => 'required',
             'description' => 'required'
            ]);

        Project::create($atrributes);

        return redirect('/projects');
    }

    public function show($id)
    {
        
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }
}
