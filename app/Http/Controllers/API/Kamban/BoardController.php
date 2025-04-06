<?php

namespace App\Http\Controllers\API\Kamban;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Services\Kamban\BoardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    protected $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function index()
    {
        $userId = Auth::id();
        return response()->json($this->boardService->getAllBoardsForUser($userId));
    }

    public function showDetails($boardId)
    {
        $userId = Auth::id();
        return response()->json($this->boardService->getBoardByIdForUser($boardId, $userId));
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        
        return response()->json($this->boardService->createBoard($data), 201);
    }

    public function show($id)
    {
        $userId = Auth::id();
        return response()->json($this->boardService->getBoardByIdForUser($id, $userId));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        return response()->json($this->boardService->updateBoardForUser($id, $userId, $request->all()));
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        return response()->json($this->boardService->deleteBoardForUser($id, $userId));
    }
}