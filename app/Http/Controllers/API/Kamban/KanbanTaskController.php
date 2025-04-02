<?php

namespace App\Http\Controllers\API\Kamban;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Kamban\KanbanTaskService;

class KanbanTaskController extends Controller
{
    protected $taskService;

    public function __construct(KanbanTaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    // Obtener todas las tareas
    public function index()
    {
        return response()->json($this->taskService->getAllTasks());
    }

    // Obtener una tarea por su ID
    public function show($id)
    {
        return response()->json($this->taskService->getTaskById($id));
    }

    // Crear una nueva tarea
    public function store(Request $request)
    {
        // Validación de los campos
        $data = $request->validate([
            'column_id'   => 'required|exists:columns,id',  // Asegurarse de que el column_id exista
            'title'       => 'required|string|max:255',     // Título requerido y con límite de caracteres
            'description' => 'nullable|string',              // Descripción es opcional
            'position'    => 'nullable|integer',             // La posición es opcional, si no se pasa será calculada
            'completed'   => 'nullable|boolean',             // Completar es opcional, si no se pasa se considera falso por defecto
            'start_date'  => 'nullable|date',                // Fecha de inicio es opcional
            'due_date'    => 'nullable|date',                // Fecha de vencimiento es opcional
        ]);

        // Crear tarea usando el servicio
        return response()->json($this->taskService->createTask($data), 201);
    }

    // Actualizar una tarea existente
    public function update(Request $request, $id)
    {
        // Validación de los campos
        $data = $request->validate([
            'column_id'   => 'nullable|exists:columns,id',  // Validar si la columna existe, si es proporcionada
            'title'       => 'nullable|string|max:255',     // Título es opcional durante la actualización
            'description' => 'nullable|string',              // Descripción es opcional
            'position'    => 'nullable|integer',             // Posición es opcional
            'completed'   => 'nullable|boolean',             // Estado de completado es opcional
            'start_date'  => 'nullable|date',                // Fecha de inicio es opcional
            'due_date'    => 'nullable|date',                // Fecha de vencimiento es opcional
        ]);

        // Actualizar tarea usando el servicio
        return response()->json($this->taskService->updateTask($id, $data));
    }

    // Eliminar una tarea
    public function destroy($id)
    {
        $this->taskService->deleteTask($id);
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
