<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request, $tagId)
    {
        $tasks = $this->taskService->getAllTasksByTag($tagId, $request->user()->id);
        return response()->json(['data' => $tasks]);
    }

    public function show(Request $request, $id)
    {
        $task = $this->taskService->getTaskById($id, $request->user()->id);
        return response()->json(['data' => $task]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'tag_id' => 'required|exists:tags,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'nullable|in:low,medium,high',
        'start_date' => 'nullable|date_format:Y-m-d H:i:s',
        'due_date' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = $this->taskService->createTask(
            $request->only('tag_id', 'name', 'description', 'priority', 'start_date', 'due_date'),
            $request->user()->id
        );

        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable|boolean',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date_format:Y-m-d H:i:s',
            'due_date' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = $this->taskService->updateTask(
            $id,
            $request->only('name', 'description', 'priority', 'completed', 'start_date', 'due_date'),
            $request->user()->id
        );

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->taskService->deleteTask($id, $request->user()->id);

        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }

    public function complete(Request $request, $id)
    {
        $task = $this->taskService->completeTask($id, $request->user()->id);

        return response()->json([
            'message' => 'Task marked as completed',
            'data' => $task,
        ]);
    }

    public function assign(Request $request, $id)
    {
        $task = $this->taskService->assignTaskToUser($id, $request->user()->id);

        return response()->json([
            'message' => 'Task assigned successfully',
            'data' => $task,
        ]);
    }
}