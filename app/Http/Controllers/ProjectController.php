<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:planning,active,on_hold,completed',
        ]);

        return Project::create($request->all());
    }

    public function show(Project $project)
    {
        return $project;
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'start_date' => 'date',
            'end_date' => 'nullable|date',
            'status' => 'in:planning,active,on_hold,completed',
        ]);

        $project->update($request->all());
        return $project;
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }

    public function overview()
{
    $projectsInProgress = Project::where('status', 'active')->count();

    $totalTasks = Task::count();
    $completedTasks = Task::where('status', 'completed')->count();

    return response()->json([
        'projects_in_progress' => $projectsInProgress,
        'total_tasks' => $totalTasks,
        'completed_tasks' => $completedTasks,
    ]);
}

}
