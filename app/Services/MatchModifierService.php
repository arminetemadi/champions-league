<?php


namespace App\Services;


use App\Repositories\MatchResultRepositoryInterface;

class MatchModifierService implements MatchModifierServiceInterface
{
    /**
     * @var MatchResultRepositoryInterface
     */
    private $matchResultRepository;

    /**
     * @var MatchScoreServiceInterface
     */
    private $matchScoreService;

    public function __construct(
        MatchResultRepositoryInterface $matchResultRepository,
        MatchScoreServiceInterface $matchScoreService
    )
    {
        $this->matchResultRepository = $matchResultRepository;
        $this->matchScoreService = $matchScoreService;
    }

    /**
     * @see MatchModifierServiceInterface::createMatchResults()
     */
    public function createMatchResults(int $week = 1) : void
    {
        $scores = $this->matchScoreService->generate($week);

        foreach ($scores as $item) {
            $this->matchResultRepository->saveResult($week, $item);
        }
    }

    public function createMatchResultsForAllWeeks() : void
    {
        for ($week = 1; $week <= 6; $week++) {
            $this->createMatchResults($week);
        }
    }

    public function removeAll() : void
    {
        $this->matchResultRepository->removeAll();
    }
}
