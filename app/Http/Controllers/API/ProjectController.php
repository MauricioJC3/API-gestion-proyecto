<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(Request $request)
    {
        $projects = $this->projectService->getAllProjects($request->user()->id);
        return response()->json(['data' => $projects]);
    }

    public function show(Request $request, $id)
    {
        $project = $this->projectService->getProjectById($id, $request->user()->id);
        return response()->json(['data' => $project]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'start_date' => 'nullable|date_format:Y-m-d H:i:s',
            'due_date' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project = $this->projectService->createProject(
            $request->only('name', 'description', 'status', 'start_date', 'due_date'),
            $request->user()->id
        );

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'start_date' => 'nullable|date_format:Y-m-d H:i:s',
            'due_date' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project = $this->projectService->updateProject(
            $id,
            $request->only('name', 'description', 'status', 'start_date', 'due_date'),
            $request->user()->id
        );

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->projectService->deleteProject($id, $request->user()->id);

        return response()->json([
            'message' => 'Project deleted successfully',
        ]);
    }
}