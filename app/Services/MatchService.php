<?php


namespace App\Services;


use App\Repositories\MatchResultRepositoryInterface;

class MatchService implements MatchServiceInterface
{
    /**
     * @var MatchResultRepositoryInterface
     */
    private $matchResultRepository;

    /**
     * @var TeamServiceInterface
     */
    private $teamService;

    public function __construct(
        MatchResultRepositoryInterface $matchResultRepository,
        TeamServiceInterface $teamService
    )
    {
        $this->matchResultRepository = $matchResultRepository;
        $this->teamService = $teamService;
    }

    /**
     * @see MatchServiceInterface::getAll()
     */
    public function getAll(int $week) : array
    {
        return $this->matchResultRepository->getAll($week);
    }

    /**
     * @see MatchServiceInterface::getByWeek()
     */
    public function getByWeek(int $week) : array
    {
        return $this->matchResultRepository->getByWeek($week);
    }
}
