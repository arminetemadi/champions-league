<?php


namespace App\Services;


use App\Repositories\MatchResultRepositoryInterface;

class MatchScoreService implements MatchScoreServiceInterface
{
    /**
     * @var TeamServiceInterface
     */
    private $teamService;

    public function __construct(
        TeamServiceInterface $teamService
    )
    {
        $this->teamService = $teamService;
    }

    /**
     * @see MatchScoreServiceInterface::generate()
     */
    public function generate(int $week) : array
    {
        $teams = $this->teamService->getAll();

        $orderedTeamsForMatch = [];
        if ($week === 1) {
            $orderedTeamsForMatch = [0, 2, 1, 3];
        } elseif ($week === 2) {
            $orderedTeamsForMatch = [3, 0, 2, 1];
        } elseif ($week === 3) {
            $orderedTeamsForMatch = [0, 1, 3, 2];
        } elseif ($week === 4) {
            $orderedTeamsForMatch = [2, 0, 3, 1];
        } elseif ($week === 5) {
            $orderedTeamsForMatch = [0, 3, 1, 2];
        } elseif ($week === 6) {
            $orderedTeamsForMatch = [1, 0, 2, 3];
        }

        $scores = [
            [
                [
                    'team' => $teams[$orderedTeamsForMatch[0]]['id'],
                    'score' => $this->random(),
                ],
                [
                    'team' => $teams[$orderedTeamsForMatch[1]]['id'],
                    'score' => $this->random(),
                ],
            ],
            [
                [
                    'team' => $teams[$orderedTeamsForMatch[2]]['id'],
                    'score' => $this->random(),
                ],
                [
                    'team' => $teams[$orderedTeamsForMatch[3]]['id'],
                    'score' => $this->random(),
                ],
            ]
        ];

        return $scores;
    }

    /**
     * @return int
     */
    private function random() : int
    {
        return rand(0, 7);
    }
}
