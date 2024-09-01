<?php

namespace App\Http\Controllers;

use App\Services\Implementation\ProjectService;
use App\Services\ProjectServiceInterface;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    protected $projectService;

    /**
     * ProjectController constructor.
     *
     * @param ProjectService $projectService
     */
    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the projects.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $projects = $this->projectService->all();
        return response()->json($projects);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = $this->projectService->create($data);
        return response()->json($project, 201);
    }

    /**
     * Display the specified project.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $project = $this->projectService->find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
        return response()->json($project);
    }

    /**
     * Update the specified project in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = $this->projectService->update($id, $data);
        return response()->json($project);
    }

    /**
     * Remove the specified project from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->projectService->delete($id);
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
