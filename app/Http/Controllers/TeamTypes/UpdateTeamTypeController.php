<?php

namespace App\Http\Controllers\TeamTypes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Services\Team\TeamTypeService;
use App\Services\Owners\OwnerGroupService;

class UpdateTeamTypeController extends Controller
{
    private $teamTypeService;
    private $ownerGroupService;

    public function __construct (
        TeamTypeService $teamTypeService,
        OwnerGroupService $ownerGroupService
    ) {
        $this->teamTypeService = $teamTypeService;
        $this->ownerGroupService = $ownerGroupService;
    }

    public function create ($uuid) {
        //FALTA COMPROBAR QUE SEA MIEMBRO DE LA COMUNIDAD
        $type = $this->teamTypeService->getTypeByUuid($uuid);

        if ($type == null) return redirect()->route('dashboard');
        else {
            $communities = $this->ownerGroupService->listBelongingCommunities(Auth::user());

            if (!$communities) {
                return redirect()
                ->to('types-admin')
                ->with('status', '0 communities found!')
                ->with('style', 'danger');
            }

            $cont = 0;
            foreach ($communities as $community) {
                if ($type->group_id == $community->id) {
                    break;
                }

                $cont += 1;
            }

            if ($cont >= count($communities)) {
                return redirect()
                ->to('types-admin')
                ->with('status', 'The team type does not belong to this user!')
                ->with('style', 'danger');
            }

            if (count($this->teamTypeService->listVinculatedTeams($type->id)) > 0) {
                return redirect()
                ->to('types-admin')
                ->with('status', 'The Team Type already haves Teams!')
                ->with('style', 'danger');
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

        $communities = $this->ownerGroupService->listBelongingCommunities(Auth::user());

        if (!$communities) {
            return redirect()
            ->to('types-admin')
            ->with('status', '0 communities found!')
            ->with('style', 'danger');
        }

        $cont = 0;
        foreach ($communities as $community) {
            if ($type->group_id == $community->id) {
                break;
            }

            $cont += 1;
        }
        
        if ($cont >= count($communities)) {
            return redirect()
            ->to('types-admin')
            ->with('status', 'The team type does not belong to this user!')
            ->with('style', 'danger');
        }
        
        if (count($this->teamTypeService->listVinculatedTeams($type->id)) > 0) {
            return redirect()
            ->to('types-admin')
            ->with('status', 'The Team Type already haves Teams!')
            ->with('style', 'danger');
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
