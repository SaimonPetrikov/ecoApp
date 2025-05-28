<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tasks.view')->only(['index', 'show']);
        $this->middleware('permission:tasks.create')->only(['store']);
        $this->middleware('permission:tasks.edit')->only(['update']);
        $this->middleware('permission:tasks.delete')->only(['destroy']);
    }

    public function index()
    {
        $this->authorize('viewAny', Task::class);
        $tasks = Task::with('creator')->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'created_by' => 'required|exists:users,id',
            'available_at' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task created successfully'
        ], 201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'created_by' => 'required|exists:users,id',
            'available_at' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task updated successfully'
        ]);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ]);
    }
}