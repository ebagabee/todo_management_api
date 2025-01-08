<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('project', 'labels');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $orderBy = $request->input('order_by', 'created_at');
        $orderDirection = $request->input('order_direction', 'desc');

        if (in_array($orderBy, ['title', 'created_at'])) {
            $query->orderBy($orderBy, $orderDirection);
        }

        return $query->get();
    }

    public function indexForProject(Project $project, Request $request)
{
    $query = $project->tasks();

    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    if ($request->has('created_at')) {
        $query->whereDate('created_at', $request->created_at);
    }

    $orderBy = $request->input('order_by', 'created_at');
    $orderDirection = $request->input('order_direction', 'desc');

    if (in_array($orderBy, ['title', 'created_at'])) {
        $query->orderBy($orderBy, $orderDirection);
    }

    return $query->get();
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:low,medium,high,urgent',
            'estimated_hours' => 'nullable|numeric',
            'actual_hours' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        if ($validated['status'] === 'completed') {
            $validated['completed_at'] = now();
        }

        $task = Task::create($validated);

        if ($request->has('label_ids')) {
            $task->labels()->sync($request->label_ids);
        }

        return $task->load('project', 'labels');
    }

    public function show(Task $task)
    {
        return $task->load('project', 'labels', 'comments');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'priority' => 'in:low,medium,high,urgent',
            'estimated_hours' => 'nullable|numeric',
            'actual_hours' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'project_id' => 'exists:projects,id',
        ]);

        if ($validated['status'] === 'completed' && !$task->completed_at) {
            $validated['completed_at'] = now();
        } elseif ($validated['status'] !== 'completed') {
            $validated['completed_at'] = null;
        }

        $task->update($validated);

        if ($request->has('label_ids')) {
            $task->labels()->sync($request->label_ids);
        }

        return $task->load('project', 'labels');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
