<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Kamban\BoardController;
use App\Http\Controllers\API\Kamban\ColumnController;
use App\Http\Controllers\API\Kamban\KanbanTagController;
use App\Http\Controllers\API\Kamban\KanbanTaskController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\TaskController;



// Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        
        // Rutas de proyectos
        Route::apiResource('projects', ProjectController::class);

        // Rutas de etiquetas
        Route::get('projects/{projectId}/tags', [TagController::class, 'index']);
        Route::post('tags', [TagController::class, 'store']);
        Route::get('tags/{id}', [TagController::class, 'show']);
        Route::put('tags/{id}', [TagController::class, 'update']);
        Route::delete('tags/{id}', [TagController::class, 'destroy']);

        // Rutas de tareas
        Route::get('tags/{tagId}/tasks', [TaskController::class, 'index']);
        Route::post('tasks', [TaskController::class, 'store']);
        Route::get('tasks/{id}', [TaskController::class, 'show']);
        Route::put('tasks/{id}', [TaskController::class, 'update']);
        Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
        Route::post('tasks/{id}/complete', [TaskController::class, 'complete']);
        Route::post('tasks/{id}/assign', [TaskController::class, 'assign']);

        // 📌 Rutas del Tablero Kanban
       Route::post('boards', [BoardController::class, 'store']);
       Route::get('boards', [BoardController::class, 'index']);
       Route::get('boards/{boardId}/details', [BoardController::class, 'showDetails']);
       Route::get('boards/{id}', [BoardController::class, 'show']);
       Route::put('boards/{id}', [BoardController::class, 'update']);
       Route::delete('boards/{id}', [BoardController::class, 'destroy']);

   
       // Rutas de Columnas dentro de un Tablero
       Route::post('boards/{board_id}/columns', [ColumnController::class, 'store']);
       Route::get('boards/{board_id}/columns', [ColumnController::class, 'index']);
       Route::get('boards/{board_id}/columns/{id}', [ColumnController::class, 'show']);
       Route::put('boards/{board_id}/columns/{id}', [ColumnController::class, 'update']);
       Route::delete('boards/{board_id}/columns/{id}', [ColumnController::class, 'destroy']);


            // Rutas para tareas de Kanban
        Route::get('kanban-tasks', [KanbanTaskController::class, 'index']);
        Route::post('kanban-tasks', [KanbanTaskController::class, 'store']);
        Route::get('kanban-tasks/{id}', [KanbanTaskController::class, 'show']);
        Route::put('kanban-tasks/{id}', [KanbanTaskController::class, 'update']);
        Route::delete('kanban-tasks/{id}', [KanbanTaskController::class, 'destroy']);

        // Rutas para etiquetas de Kanban
        Route::get('kanban-tags', [KanbanTagController::class, 'index']);
        Route::post('kanban-tags', [KanbanTagController::class, 'store']);
        Route::get('kanban-tags/{id}', [KanbanTagController::class, 'show']);
        Route::put('kanban-tags/{id}', [KanbanTagController::class, 'update']);
        Route::delete('kanban-tags/{id}', [KanbanTagController::class, 'destroy']);
        
});