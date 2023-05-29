<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('front.user.project.index');
    }

    public function showCreateProject()
    {
        return view('front.user.project.create');
    }

    public function showEditProject(Project $project)
    {
        return view('front.user.project.edit', compact('project'));
    }

    public function show(Project $project)
    {
        return view('front.user.project.show', compact('project'));
    }

    public function myProjects()
    {
        return view('front.user.project.my_projects');
    }
}
