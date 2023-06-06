<?php

namespace App\Http\Controllers\TeamTypes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Services\Team\TeamTypeService;

class UpdateTeamTypeController extends Controller
{
    private $teamTypeService;

    public function __construct (TeamTypeService $teamTypeService) {
        $this->teamTypeService = $teamTypeService;
    }

    public function create ($id) {
        $type = $this->teamTypeService->getType($id);

        if ($type == null) return redirect()->route('dashboard');
        else {
            if (Auth::user()->id != $type->user_id) {   
                return redirect()->route('types-admin')->with('status', 'You cant update a team type that is not yours')->with('style', 'danger');
            }
        }

        return view ('types-admin.update-team-type', [
            'type' => $type
        ]);
    }

    public function update (Request $req) {
        $type = $this->teamTypeService->getType($req['id']);

        if ($type == null) return redirect()->route('dashboard');    

        if ($type->user_id != Auth::user()->id) {
            return redirect()->route('types-admin')->with('status', "You cant update a team type that is not yours")->with('style', 'danger');
        } 

        $req->validate([
            'id' => ['required', 'numeric', 'min:1'],
            'name' => ['required', 'string', 'max:255'],
            'sip' => ['required', 'numeric'],
            'central' => ['required', 'numeric'],
            'marketing' => ['required', 'numeric'],
            'support' => ['required', 'numeric']
        ]);
        
        $data = [
            'id' => $req['id'],
            'name' => $req['name'],
            'sip' => $req['sip'],
            'central' => $req['central'],
            'marketing' => $req['marketing'],
            'support' => $req['support']
        ];

        if ($this->teamTypeService->updateType($data['id'], $data)) {
            return redirect()->route('types-admin')->with('status', 'Team Type ' . ucfirst($data['name']) . ' updated successfully!')->with('style', 'success');
        } else {
            return redirect()->route('types-admin')->with('status', 'Something ocurred while updating ' . $data['name'] . ' team type!')->with('style', 'danger');
        }
    }   
}
