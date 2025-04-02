<?php

namespace App\Http\Controllers\API\Kamban;

use App\Services\Kamban\KanbanTagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KanbanTagController extends Controller
{
    protected $tagService;

    public function __construct(KanbanTagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        return response()->json($this->tagService->getAllTags());
    }

    public function show($id)
    {
        return response()->json($this->tagService->getTagById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'board_id' => 'required|exists:boards,id',
            'name'     => 'required|string|max:255',
            'color'    => 'nullable|string|max:7' // Hex code
        ]);

        return response()->json($this->tagService->createTag($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'board_id' => 'exists:boards,id',
            'name'     => 'string|max:255',
            'color'    => 'nullable|string|max:7'
        ]);

        return response()->json($this->tagService->updateTag($id, $data));
    }

    public function destroy($id)
    {
        $this->tagService->deleteTag($id);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
