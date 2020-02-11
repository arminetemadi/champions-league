<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\LeagueDataSorterServiceInterface;
use App\Services\LeagueServiceInterface;
use App\Services\MatchModifierServiceInterface;
use App\Services\MatchResultFormatterServiceInterface;
use App\Services\MatchServiceInterface;
use App\Services\PredictionServiceInterface;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    /**
     * @var MatchServiceInterface
     */
    private $matchService;

    /**
     * @var MatchModifierServiceInterface
     */
    private $matchModifierService;

    /**
     * @var LeagueServiceInterface
     */
    private $leagueService;

    /**
     * @var MatchResultFormatterServiceInterface
     */
    private $matchResultFormatterService;

    /**
     * @var LeagueDataSorterServiceInterface
     */
    private $leagueDataSorter;

    /**
     * @var PredictionServiceInterface
     */
    private $predictionService;

    public function __construct(
        MatchServiceInterface $matchService,
        MatchModifierServiceInterface $matchModifierService,
        LeagueServiceInterface $leagueService,
        MatchResultFormatterServiceInterface $matchResultFormatterService,
        LeagueDataSorterServiceInterface $leagueDataSorter,
        PredictionServiceInterface $predictionService
    ) {
        $this->matchService = $matchService;
        $this->matchModifierService = $matchModifierService;
        $this->leagueService = $leagueService;
        $this->matchResultFormatterService = $matchResultFormatterService;
        $this->leagueDataSorter = $leagueDataSorter;
        $this->predictionService = $predictionService;
    }

    /**
     * return the league table data, match results & predictions after week 4th.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $request->validate([
            'week' => 'integer|max:6',
        ]);
        $week = $request->input('week', 1);

        $this->matchModifierService->createMatchResults($week);
        $tableResult = $this->leagueService->calculateData($week);
        $sortedTableResult = $this->leagueDataSorter->sort($tableResult);
        $matchResult = $this->matchResultFormatterService->getResults($week);
        $predictionResult = ($week >= 4) ? $this->predictionService->calculatePredictions($sortedTableResult) : [];

        return response()->json([
            'tableResult' => $sortedTableResult,
            'matchResult' => $matchResult,
            'predictionResult' => $predictionResult
        ]);
    }

    /**
     * reset all match results, fill them again and start over from week 1th!
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function playall()
    {
        $this->matchModifierService->removeAll();
        $this->matchModifierService->createMatchResultsForAllWeeks();

        return response()->json(true);
    }
}
