<?php

namespace App\Http\Controllers\TeamTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamService;
use App\Services\Team\TeamTypeHistoryService;

class UpdateTeamTypeHistoryController extends Controller
{
    private $teamTypeHistorySevice;
    private $teamService;

    public function __construct (
        TeamTypeHistoryService $teamTypeHistorySevice,
        TeamService $teamService
        ) {
        $this->teamTypeHistoryService = $teamTypeHistorySevice;
        $this->teamService = $teamService;
    }

    public function update (Request $req) {
        $actualTeamType = $this->teamTypeHistoryService->getTeamTypeHistory(
            $this->teamService->getTeam(Auth::user()->current_team_id)
        );

        try {

            $this->teamTypeHistoryService->updateTeamTypeHistory ($actualTeamType[0]['id'], $req['type']);
            
            return redirect()->back()->with('status', 'Team Type updated successfully!')->with('style', 'success');
        } catch (Throwable $e) {
            return redirect()->back()->with('status', 'Something ocurred while updating the team type, try later')->with('style', 'danger');
        }
    }
}
