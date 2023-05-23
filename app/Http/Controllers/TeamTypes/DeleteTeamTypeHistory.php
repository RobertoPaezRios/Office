<?php

namespace App\Http\Controllers\TeamTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamTypeHistoryService;

class DeleteTeamTypeHistory extends Controller
{
    private $teamTypeHistoryService;

    public function __construct (TeamTypeHistoryService $teamTypeHistoryService) {
        $this->teamTypeHistoryService = $teamTypeHistoryService;
    }

    public function destroy ($id) {
        $res = $this->teamTypeHistoryService->destroyTeamTypeHistory($id);

        if (!$res) {   
            return redirect('/teams/' . Auth::user()->current_team_id)->with('status', 'Something occured while deleting the register, try later!')->with('style', 'danger');
        }

        return redirect('/teams/' . Auth::user()->current_team_id)->with('status', 'Register deleted successfully!')->with('style', 'success');
    }
}
