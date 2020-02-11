<?php


namespace App\Services;


interface MatchScoreServiceInterface
{
    public function generate(int $week) : array;
}
