<?php


namespace App\Services;


interface MatchServiceInterface
{
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
}
