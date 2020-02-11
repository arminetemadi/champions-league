<?php


namespace App\Repositories;

use App\Entities\MatchResult;
use App\Entities\Team;

class MatchResultRepository implements MatchResultRepositoryInterface
{
    /**
     * @var MatchResult
     */
    private $matchResult;

    public function __construct(MatchResult $matchResult)
    {
        $this->matchResult = $matchResult;
    }

    /**
     * @see MatchResultRepositoryInterface::saveResult()
     */
    public function saveResult(int $week, array $scores) : bool
    {
        return $this->matchResult
            ->query()
            ->insertOrIgnore([
                'week' => $week,
                'home' => $scores[0]['team'],
                'home_score' => $scores[0]['score'],
                'away' => $scores[1]['team'],
                'away_score' => $scores[1]['score'],
            ]);
    }

    /**
     * @see MatchResultRepositoryInterface::getAll()
     */
    public function getAll(int $week) : array
    {
        return $this->matchResult
            ->query()
            ->where('week', '<=', $week)
            ->with('home', 'away')
            ->get()
            ->toArray();
    }

    /**
     * @see MatchResultRepositoryInterface::getByWeek()
     */
    public function getByWeek(int $week) : array
    {
        return $this->matchResult
            ->query()
            ->where('week', $week)
            ->with('home', 'away')
            ->get()
            ->toArray();
    }

    public function removeAll() : void
    {
        $this->matchResult
            ->query()
            ->delete();
    }
}
