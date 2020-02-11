<?php


namespace App\Services;


class LeagueService implements LeagueServiceInterface
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
     * @see LeagueServiceInterface::calculateData()
     */
    public function calculateData(int $week = 1) : array
    {
        $result = [];
        $matches = $this->matchService->getAll($week);
        foreach ($matches as $match) {
            $home = $match['home'];
            $away = $match['away'];
            if (!isset($result[$match['home']['id']])) {
                $result[$home['id']] = [
                    'name' => $home['name'],
                    'pts' => 0,
                    'p' => 0,
                    'w' => 0,
                    'd' => 0,
                    'l' => 0,
                    'gd' => 0,
                    'gs' => 0,
                ];
            }
            if (!isset($result[$match['away']['id']])) {
                $result[$away['id']] = [
                    'name' => $away['name'],
                    'pts' => 0,
                    'p' => 0,
                    'w' => 0,
                    'd' => 0,
                    'l' => 0,
                    'gd' => 0,
                    'gs' => 0,
                ];
            }

            // 1 => home win, 0 => draw, -1 => home loose
            $homeWin = (($match['home_score'] > $match['away_score']) ? 1 : ($match['home_score'] == $match['away_score'] ? 0 : -1));

            $result[$home['id']] = [
                'name' => $home['name'],
                'pts' => $result[$home['id']]['pts'] + ($homeWin === 1 ? 3 : ($homeWin === 0 ? 1 : 0)),
                'p' => $result[$home['id']]['p'] + 1,
                'w' => $result[$home['id']]['w'] + ($homeWin === 1 ? 1 : 0),
                'd' => $result[$home['id']]['d'] + ($homeWin === 0 ? 1 : 0),
                'l' => $result[$home['id']]['l'] + ($homeWin === -1 ? 1 : 0),
                'gd' => $result[$home['id']]['gd'] + ($match['home_score'] - $match['away_score']),
                'gs' => $result[$home['id']]['gs'] + $match['home_score'],
            ];
            $result[$away['id']] = [
                'name' => $away['name'],
                'pts' => $result[$away['id']]['pts'] + ($homeWin === -1 ? 3 : ($homeWin === 0 ? 1 : 0)),
                'p' => $result[$away['id']]['p'] + 1,
                'w' => $result[$away['id']]['w'] + ($homeWin === -1 ? 1 : 0),
                'd' => $result[$away['id']]['d'] + ($homeWin === 0 ? 1 : 0),
                'l' => $result[$away['id']]['l'] + ($homeWin === 1 ? 1 : 0),
                'gd' => $result[$away['id']]['gd'] + ($match['away_score'] - $match['home_score']),
                'gs' => $result[$away['id']]['gs'] + $match['away_score'],
            ];
        }

        return $result;
    }
}
