@extends('layouts.app')

@section('title', 'League Table & Results')

@section('content')
    <div>
        <div>
            <table class="bordered" cellspacing="0">
                <tr>
                    <td align="center"><h3>League Table</h3></td>
                    <td align="center"><h3>Match Results</h3></td>
                </tr>
                <tr>
                    <td>
                        <table id="league_table" cellpadding="0">
                            <tr>
                                <th>TEAMS</th>
                                <th>PTS</th>
                                <th>P</th>
                                <th>W</th>
                                <th>D</th>
                                <th>L</th>
                                <th>GD</th>
                            </tr>
                            <tr class="loading">
                                <td colspan="7">Loading ...</td>
                            </tr>
                        </table>
                    </td>
                    <td align="center" class="match-result-wrapper">
                        <h5>
                            <span class="week-number">1<sup>th</sup> </span>
                            week match result
                        </h5>
                        <table id="match_result">
                            <tr class="loading">
                                <td colspan="3">Loading ...</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <button id="playall" disabled>Play All</button>
                    </td>
                    <td align="right">
                        <button id="next_week" disabled>Next</button>
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <table id="prediction">
                <tr>
                    <td colspan="2">
                        <p><h5>
                            <span class="week-number">1<sup>th</sup> </span>
                            Week Predictions of Championship
                        </h5></p>
                    </td>
                </tr>
                <tr class="loading">
                    <td colspan="2">Loading ...</td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            let week = 1;
            getWeekData(week);

            $('#next_week').on('click', function() {
                if (week < 6) {
                    week++;
                    if (week >= 4) {
                        $('#prediction').show();
                    }
                    getWeekData(week);
                }
            });

            $('#playall').on('click', function() {
                week = 1;
                playall();
            });
        });

        function getWeekData(week) {
            $('.data').remove();
            $('#message').remove();
            $('#playall').prop('disabled', true);
            $('#next_week').prop('disabled', true);
            $('.loading').show();

            $.ajax({
                url: '/api/v1/league',
                data: {
                    week: week
                },
                success: function( result ) {
                    $('.loading').hide();

                    fillLeagueTable(result.tableResult);
                    fillMatchResult(result.matchResult);
                    fillPredictions(result.predictionResult, week);

                    $('#playall').prop('disabled', false);
                    if (week < 6) {
                        $('#next_week').prop('disabled', false);
                    }

                    $('.week-number').html(weekString(week));
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('.loading').hide();
                    let $tr = $('<tr id="message">').append(
                        $('<td colspan="7">').text('An error occured!')
                    ).appendTo('#league_table');
                }
            });
        }

        function playall() {
            $('.data').remove();
            $('#message').remove();
            $('#playall').prop('disabled', true);
            $('#next_week').prop('disabled', true);
            $('.loading').show();
            $('#prediction').hide();

            $.ajax({
                method: 'post',
                url: '/api/v1/league/playall',
                success: function( result ) {
                    getWeekData(1);
                }
            });
        }

        function fillLeagueTable(data) {
            $.each(data, function(i, item) {
                let $tr = $('<tr class="data">').append(
                    $('<td>').text(item.name),
                    $('<td align="center">').text(item.pts),
                    $('<td align="center">').text(item.p),
                    $('<td align="center">').text(item.w),
                    $('<td align="center">').text(item.d),
                    $('<td align="center">').text(item.l),
                    $('<td align="center">').text(item.gd)
                ).appendTo('#league_table');
            });
        }

        function fillMatchResult(data) {
            $.each(data, function(i, item) {
                let $tr = $('<tr class="data">').append(
                    $('<td>').text(item.home.name),
                    $('<td>').text(item.home.score + ' - ' + item.away.score),
                    $('<td>').text(item.away.name)
                ).appendTo('#match_result');
            });
        }

        function fillPredictions(data, week) {
            if (week < 4) {
                return;
            }

            $.each(data, function (i, item) {
                let $tr = $('<tr class="data">').append(
                    $('<td>').text(item.name),
                    $('<td>').text(item.percent + '%')
                ).appendTo('#prediction');
            });
        }

        function weekString(week) {
            if (week === 1 || week === 4 || week === 5 || week === 6) {
                return week + '<sup>th</span>';
            } else if (week === 2) {
                return week + '<sup>nd</sup>';
            } else {
                return week + '<sup>rd</sup>';
            }
        }
    </script>
@endsection
