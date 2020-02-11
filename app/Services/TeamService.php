<?php


namespace App\Services;


use App\Repositories\TeamRepositoryInterface;

class TeamService implements TeamServiceInterface
{
    /**
     * @var TeamRepositoryInterface
     */
    private $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @see TeamServiceInterface::getAll()
     */
    public function getAll() : array
    {
        return $this->teamRepository->getAll();
    }
}
