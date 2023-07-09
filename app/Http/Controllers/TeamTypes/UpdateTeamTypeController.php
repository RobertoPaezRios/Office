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

    public function create ($uuid) {
        $type = $this->teamTypeService->getTypeByUuid($uuid);

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

    public function update (Request $req, $uuid) {
        $type = $this->teamTypeService->getTypeByUuid($uuid);

        if (is_null($type)) {
            return redirect()
            ->to('types-admin')
            ->with('status', 'Type not found!')
            ->with('style', 'danger');    
        }

        if ($type->user_id != Auth::user()->id) {
            return redirect()->route('types-admin')->with('status', "You cant update a team type that is not yours")->with('style', 'danger');
        } 

        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'sip' => ['required', 'numeric'],
            'central' => ['required', 'numeric'],
            'marketing' => ['required', 'numeric'],
            'support' => ['required', 'numeric']
        ]);
        
        $data = [
            'name' => $req['name'],
            'sip' => $req['sip'],
            'central' => $req['central'],
            'marketing' => $req['marketing'],
            'support' => $req['support'],
            'uuid' => $uuid
        ];

        if ($this->teamTypeService->updateType($type->id, $data)) {
            return redirect()->route('types-admin')->with('status', 'Team Type ' . ucfirst($data['name']) . ' updated successfully!')->with('style', 'success');
        } else {
            return redirect()->route('types-admin')->with('status', 'Something ocurred while updating ' . $data['name'] . ' team type!')->with('style', 'danger');
        }
    }   
}
