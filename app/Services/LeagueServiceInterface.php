<?php


namespace App\Services;


interface LeagueServiceInterface
{
    /**
     * @param int $week
     * @return array
     */
    public function calculateData(int $week = 1) : array;
}
