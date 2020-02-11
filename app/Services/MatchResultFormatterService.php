<?php


namespace App\Services;


use App\Repositories\MatchResultRepositoryInterface;

class MatchResultFormatterService implements MatchResultFormatterServiceInterface
{
    /**
     * @var MatchServiceInterface
     */
    private $matchService;

    public function __construct(
        MatchServiceInterface $matchService
    )
    {
        $this->matchService = $matchService;
    }

    /**
     * @see MatchResultFormatterServiceInterface::getResults()
     */
    public function getResults(int $week) : array
    {
        $result = [];
        $matches = $this->matchService->getByWeek($week);

        foreach ($matches as $match) {
            $result[] = [
                'home' => [
                    'name' => $match['home']['name'],
                    'score' => $match['home_score'],
                ],
                'away' => [
                    'name' => $match['away']['name'],
                    'score' => $match['away_score'],
                ]
            ];
        }

        return $result;
    }
}
