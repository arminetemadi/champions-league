<?php

namespace App\Providers;

use App\Repositories\MatchResultRepository;
use App\Repositories\MatchResultRepositoryInterface;
use App\Repositories\TeamRepository;
use App\Repositories\TeamRepositoryInterface;
use App\Services\LeagueDataSorterService;
use App\Services\LeagueDataSorterServiceInterface;
use App\Services\LeagueService;
use App\Services\LeagueServiceInterface;
use App\Services\MatchModifierService;
use App\Services\MatchModifierServiceInterface;
use App\Services\MatchResultFormatterService;
use App\Services\MatchResultFormatterServiceInterface;
use App\Services\MatchScoreService;
use App\Services\MatchScoreServiceInterface;
use App\Services\MatchService;
use App\Services\MatchServiceInterface;
use App\Services\PredictionService;
use App\Services\PredictionServiceInterface;
use App\Services\TeamService;
use App\Services\TeamServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(TeamServiceInterface::class, TeamService::class);
        $this->app->bind(MatchResultRepositoryInterface::class, MatchResultRepository::class);
        $this->app->bind(MatchServiceInterface::class, MatchService::class);
        $this->app->bind(LeagueServiceInterface::class, LeagueService::class);
        $this->app->bind(MatchResultFormatterServiceInterface::class, MatchResultFormatterService::class);
        $this->app->bind(LeagueDataSorterServiceInterface::class, LeagueDataSorterService::class);
        $this->app->bind(PredictionServiceInterface::class, PredictionService::class);
        $this->app->bind(MatchModifierServiceInterface::class, MatchModifierService::class);
        $this->app->bind(MatchScoreServiceInterface::class, MatchScoreService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
