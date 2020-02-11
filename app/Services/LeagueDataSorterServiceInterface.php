<?php


namespace App\Services;


interface LeagueDataSorterServiceInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function sort(array $data) : array;
}
