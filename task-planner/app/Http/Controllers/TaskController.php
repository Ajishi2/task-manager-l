<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::latest()->get();
        
        if (request()->wantsJson()) {
            return response()->json($tasks);
        }
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Task creation request:', $request->all());
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|string|in:pending,in-progress,completed',
                'due_date' => 'required|date',
                'priority' => 'nullable|string|in:low,medium,high',
                'category' => 'nullable|string|max:100',
            ]);
            
            Log::info('Validated data:', $validated);
            
            $task = Task::create($validated);
            
            Log::info('Task created:', $task->toArray());

            if ($request->wantsJson()) {
                return response()->json($task, 201);
            }

            return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            Log::error('Task creation error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
            
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,in-progress,completed',
            'due_date' => 'required|date',
            'priority' => 'nullable|string|in:low,medium,high',
            'category' => 'nullable|string|max:100',
        ]);

        $task->update($validated);

        if ($request->wantsJson()) {
            return response()->json($task);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

    /**
     * Get task statistics.
     */
    public function statistics()
    {
        // Debug the actual values in the database
        $allStatuses = Task::select('status')->distinct()->get()->pluck('status');
        Log::info('Available task statuses in database:', $allStatuses->toArray());
        
        $stats = [
            'total' => Task::count(),
            'pending' => Task::where('status', 'pending')->count(),
            'in_progress' => Task::where('status', 'in-progress')->count(),
            'completed' => Task::where('status', 'completed')->count(),
        ];
        
        Log::info('Statistics calculated:', $stats);
        return response()->json($stats);
    }
}