<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Projects', [
            //'projects' => Project::query()->where(['owner' => Auth::user()->id])->paginate()
            'projects' => Project::paginate(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return inertia('Project', [
            'project' => $project->load('comments'),
        ]);
    }

}
