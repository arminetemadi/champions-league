<?php


namespace App\Services;


class PredictionService implements PredictionServiceInterface
{
    /**
     * @see PredictionServiceInterface::calculatePredictions()
     */
    public function calculatePredictions(array $data) : array
    {
        $result = [];
        $sum = array_sum(array_map(function($item) {
            return $item['pts'];
        }, $data));

        foreach ($data as $key => $item) {
            $result[$key] = [
                'name' => $item['name'],
                'percent' => number_format(($item['pts'] / $sum) * 100, 2),
            ];
        }

        return $result;
    }
}
