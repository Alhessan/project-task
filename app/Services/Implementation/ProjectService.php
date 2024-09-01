<?php

namespace App\Services\Implementation;


use App\Repository\ProjectRepositoryInterface;


use App\Models\Project;
use App\Repository\Eloquent\ProjectRepository;
use App\Services\ProjectServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectService implements ProjectServiceInterface
{
    protected $projectRepository;

    /**
     * ProjectService constructor.
     *
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get all projects.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->projectRepository->all();
    }

    /**
     * Create a new project.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->projectRepository->create($data);
    }

    /**
     * Find a project by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->projectRepository->find($id);
    }

    /**
     * Update a project by ID.
     *
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function update(int $id, array $data): ?Model
    {
        return $this->projectRepository->update($id, $data);
    }

    /**
     * Delete a project by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->projectRepository->delete($id);
    }
}
