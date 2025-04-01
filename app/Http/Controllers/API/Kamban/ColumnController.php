<?php

namespace App\Http\Controllers\API\Kamban;

use App\Http\Controllers\Controller;
use App\Services\Kamban\ColumnService;

use Illuminate\Http\Request;

class ColumnController extends Controller
{
    protected $columnService;

    public function __construct(ColumnService $columnService)
    {
        $this->columnService = $columnService;
    }

    public function index()
    {
        return response()->json($this->columnService->getAllColumns());
    }

    public function store(Request $request)
    {
        return response()->json($this->columnService->createColumn($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json($this->columnService->getColumnById($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->columnService->updateColumn($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json($this->columnService->deleteColumn($id));
    }
}