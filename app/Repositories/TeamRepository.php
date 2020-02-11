<?php


namespace App\Repositories;

use App\Entities\Team;

class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @var Team
     */
    private $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @see TeamRepositoryInterface::getAll()
     */
    public function getAll() : array
    {
        return $this->team
            ->query()
            ->get()
            ->toArray();
    }
}
