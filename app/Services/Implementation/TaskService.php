<?php

namespace App\Services\Implementation;
use App\Models\Task;
use App\Repository\Eloquent\TaskRepository;
use App\Services\Implementation\Base\BaseService;
use App\Services\TaskServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskService extends BaseService implements TaskServiceInterface
{
    protected $taskRepository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        parent::__construct($taskRepository);
        $this->taskRepository = $taskRepository;
    }

    /**
     * Find all tasks by project ID.
     *
     * @param int $projectId
     * @return Collection
     */
    public function findByProjectId(int $projectId): Collection
    {
        return $this->taskRepository->findByProjectId($projectId);
    }

    /**
     * Get all tasks for a specific project.
     *
     * @param int $projectId
     * @return Collection
     */
    public function getTasksByProjectId(int $projectId): Collection
    {
        return $this->taskRepository->findAllByProjectId($projectId);
    }

    /**
     * Create a new task for a specific project.
     *
     * @param int $projectId
     * @param array $data
     * @return Task
     */
    public function createTaskForProject(int $projectId, array $data): Task
    {
        $data['project_id'] = $projectId;
        $ret = $this->taskRepository->create($data) ;
        return  $ret instanceof Task? $ret  : throw new \InvalidArgumentException('Failed to create task');
    }

    /**
     * Find a specific task within a project.
     *
     * @param int $projectId
     * @param int $taskId
     * @return Task|null
     */
    public function findTask(int $projectId, int $taskId): ?Task
    {
        $task = $this->taskRepository->find($taskId);
        if ($task && $task->project_id == $projectId) {
            return $task;
        }
        return null; // Return null if the task doesn't belong to the project
    }

    /**
     * Update a specific task within a project.
     *
     * @param int $projectId
     * @param int $taskId
     * @param array $data
     * @return Task
     */
    public function updateTask(int $projectId, int $taskId, array $data): Task
    {
        $task = $this->findTask($projectId, $taskId);
        if ($task) {
            $this->taskRepository->update($taskId, $data);
            return $task;
        }
        throw new \InvalidArgumentException("Task not found or does not belong to the specified project.");
    }

    /**
     * Delete a specific task within a project.
     *
     * @param int $projectId
     * @param int $taskId
     * @return void
     */
    public function deleteTask(int $projectId, int $taskId): void
    {
        $task = $this->findTask($projectId, $taskId);
        if ($task) {
            $this->taskRepository->delete($taskId);
        } else {
            throw new \InvalidArgumentException("Task not found or does not belong to the specified project.");
        }
    }
}
