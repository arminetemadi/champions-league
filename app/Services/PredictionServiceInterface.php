<?php


namespace App\Services;


interface PredictionServiceInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function calculatePredictions(array $data) : array;
}
