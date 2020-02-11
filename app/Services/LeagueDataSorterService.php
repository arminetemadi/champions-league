<?php


namespace App\Services;


class LeagueDataSorterService implements LeagueDataSorterServiceInterface
{

    /**
     * @see LeagueDataSorterServiceInterface::sort()
     */
    public function sort(array $data) : array
    {
        $result = $data;
        usort($result, function($a, $b) {
            return
                ($b['pts'] != $a['pts'])
                    ? $b['pts'] - $a['pts']
                    : (($b['gd'] != $a['gd'])
                        ? $b['gd'] - $a['gd']
                        : $b['gs'] - $a['gs']
                    );
        });

        return $result;
    }
}
