<?php


namespace App\Services;


interface MatchResultFormatterServiceInterface
{
    /**
     * @param int $week
     * @return array
     */
    public function getResults(int $week) : array;
}
