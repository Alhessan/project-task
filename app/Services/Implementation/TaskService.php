<?php

namespace App\Services\Implementation;
use App\Models\Task;
use App\Repository\Eloquent\TaskRepository;
use App\Services\TaskServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskService implements TaskServiceInterface
{
    protected $taskRepository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get all tasks.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->taskRepository->all();
    }

    /**
     * Create a new task.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->taskRepository->create($data);
    }

    /**
     * Find a task by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->taskRepository->find($id);
    }

    /**
     * Update a task by ID.
     *
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function update(int $id, array $data): ?Model
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * Delete a task by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->taskRepository->delete($id);
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
