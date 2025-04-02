<?php

namespace App\Http\Controllers\API\Kamban;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Services\Kamban\BoardService;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    protected $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function index()
    {
        return response()->json($this->boardService->getAllBoards());
    }

    public function showDetails($boardId)
    {
        return response()->json($this->boardService->getBoardById($boardId));
    }
    

    public function store(Request $request)
    {
        return response()->json($this->boardService->createBoard($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json($this->boardService->getBoardById($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->boardService->updateBoard($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json($this->boardService->deleteBoard($id));
    }
}