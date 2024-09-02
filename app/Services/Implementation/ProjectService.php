<?php

namespace App\Services\Implementation;


use App\Repository\ProjectRepositoryInterface;


use App\Models\Project;
use App\Repository\Eloquent\ProjectRepository;
use App\Services\Implementation\Base\BaseService;
use App\Services\ProjectServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectService extends BaseService implements ProjectServiceInterface
{
    protected $projectRepository;

    /**
     * ProjectService constructor.
     *
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        parent::__construct($projectRepository);
        $this->projectRepository = $projectRepository;
    }

}
