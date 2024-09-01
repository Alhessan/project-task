<?php

namespace App\Http\Controllers;

use App\Services\TaskServiceInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    /**
     * TaskController constructor.
     *
     * @param TaskServiceInterface $taskService
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the tasks for a specific project.
     *
     * @param int $projectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($projectId)
    {
        $tasks = $this->taskService->getTasksByProjectId($projectId);
        return response()->json($tasks);
    }

    /**
     * Store a newly created task in the specified project.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $projectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $projectId)
    {
        $task = $this->taskService->createTaskForProject($projectId, $request->all());
        return response()->json($task, 201);
    }

    /**
     * Display the specified task.
     *
     * @param int $projectId
     * @param int $taskId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($projectId, $taskId)
    {
        $task = $this->taskService->findTask($projectId, $taskId);
        return response()->json($task);
    }

    /**
     * Update the specified task in the specified project.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $projectId
     * @param int $taskId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $projectId, $taskId)
    {
        $task = $this->taskService->updateTask($projectId, $taskId, $request->all());
        return response()->json($task);
    }

    /**
     * Remove the specified task
     *
     * @param int $taskId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( $taskId)
    {
        $this->taskService->delete( $taskId);
        return response()->json(null, 204);
    }
}
