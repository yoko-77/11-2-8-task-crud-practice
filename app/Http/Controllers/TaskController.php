<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', 1)->get();
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        $data = array_merge($validated, [
            'user_id' => 1,
            'status' => 'pending',
        ]);
        $task = Task::create($data);
        return (new TaskResource($task))
            ->additional(['message' => 'タスク作成済'])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('user_id', 1)->find($id);
        if (!$task) {
            return response()->json(['message' => 'タスク無し', 'error_code' => 'TASK_NOT_FOUND'], 404);
        }
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::where('user_id', 1)->find($id);
        if (!$task) {
            return response()->json(['message' => 'タスク無し', 'error_code' => 'TASK_NOT_FOUND'], 404);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);
        $task->update($validated);
        return (new TaskResource($task))->additional(['message' => 'タスク更新済']);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('user_id', 1)->find($id);
        if (!$task) {
            return response()->json(['message' => 'タスク無し', 'error_code' => 'TASK_NOT_FOUND'], 404);
        }
        $task->delete();
        return response()->json(null, 204);

    }
}
