<?php


namespace App\Repositories;


interface MatchResultRepositoryInterface
{
    /**
     * @param int $week
     * @param array $scores
     * @return bool
     */
    public function saveResult(int $week, array $scores) : bool;

    /**
     * @param int $week
     * @return array
     */
    public function getAll(int $week) : array;

    /**
     * @param int $week
     * @return array
     */
    public function getByWeek(int $week) : array;

    public function removeAll() : void;
}
