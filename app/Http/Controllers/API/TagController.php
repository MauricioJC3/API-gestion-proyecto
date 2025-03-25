<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TagService;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(Request $request, $projectId)
    {
        $tags = $this->tagService->getAllTagsByProject($projectId, $request->user()->id);
        return response()->json(['data' => $tags]);
    }

    public function show(Request $request, $id)
    {
        $tag = $this->tagService->getTagById($id, $request->user()->id);
        return response()->json(['data' => $tag]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'color' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tag = $this->tagService->createTag(
            $request->only('project_id', 'name', 'color'),
            $request->user()->id
        );

        return response()->json([
            'message' => 'Tag created successfully',
            'data' => $tag,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'color' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tag = $this->tagService->updateTag(
            $id,
            $request->only('name', 'color'),
            $request->user()->id
        );

        return response()->json([
            'message' => 'Tag updated successfully',
            'data' => $tag,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->tagService->deleteTag($id, $request->user()->id);

        return response()->json([
            'message' => 'Tag deleted successfully',
        ]);
    }
}