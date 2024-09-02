<?php

namespace App\Http\Controllers;

use App\Services\Implementation\ProjectService;
use App\Services\ProjectServiceInterface;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

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
     * Sophisticated index method with more Advanced search and pagination
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        Log::debug('ProjectController@index');
        $perPage = $request->input('per_page', 15);
        $orderBy = $request->input('order_by', 'id');
        $orderType = $request->input('order_type', 'desc');
        $keyword = $request->input('keyword', null);
        $projects = $this->projectService->query();
        if ($keyword) {
            $projects = $projects->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        }
        $projects = $projects
            ->orderBy($orderBy, $orderType)
            ->paginate($perPage);

        //log projects
        Log::info('projects: ' );
        Log::info($projects);

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
