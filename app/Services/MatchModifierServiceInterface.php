<?php


namespace App\Services;


interface MatchModifierServiceInterface
{
    /**
     * @param int $week
     */
    public function createMatchResults(int $week = 1) : void;

    public function createMatchResultsForAllWeeks() : void;

    public function removeAll() : void;
}
