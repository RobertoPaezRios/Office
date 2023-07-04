<?php

namespace App\Http\Controllers\OwnerGroups;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Services\Owners\OwnerGroupService;
use App\Services\Owners\OwnerService;
use App\Services\Team\TeamService;

class UpdateGroupController extends Controller
{
    private $ownerGroupService;
    private $teamService;
    private $ownerService;

    public function __construct (
        OwnerGroupService $ownerGroupService,
        TeamService $teamService,
        OwnerService $ownerService
    ) {
        $this->ownerGroupService = $ownerGroupService;
        $this->teamService = $teamService;
        $this->ownerService = $ownerService;
    }   

    public function create ($id) {
        $group = $this->ownerGroupService->getGroup($id);
        $members = $this->ownerService->listMembersByGroupId($group->id);
        
        if (count($this->teamService->listTeamsByGroupId($group->id)) > 0) {
            return view ('owners-group.update-group', [
                'name' => $group->name,
                'owner' => $group->owner,
                'id' => $group->id,
                'color' => $group->color,
                'status' => false
            ]);
        }

        if ($group->owner->id != Auth::user()->id && count($this->ownerService->belongsTo(Auth::user()->id, $group->id)) == 0) {
            return redirect()
            ->route('partners-admin')
            ->with('status', 'You may edit only your communities')
            ->with('style', 'danger');
        }

        return view ('owners-group.update-group', [
            'name' => $group->name,
            'owner' => $group->owner,
            'id' => $group->id,
            'color' => $group->color,
            'status' => true
        ]);
    }

    public function update ($id, Request $req) {
        $req->validate([
            'name' => ['string', 'max:255'],
            'color' => ['string', 'max:7']
        ]);

        if ($req['color'][0] != '#') {
            return redirect()
            ->back()
            ->with('status', 'Color must be hexadecimal')
            ->with('style', 'danger');
        }

        $group = $this->ownerGroupService->getGroup($id);

        if (count($this->teamService->listTeamsByGroupId($group->id)) > 0) {
            return redirect()
            ->route('partners-admin')
            ->with('status', 'The community ' . $group->name . "cant't be updated")
            ->with('status', 'danger');
        }

        if ($group->owner->id != Auth::user()->id && count($this->ownerService->belongsTo(Auth::user()->id, $group->id)) == 0) {
            return redirect()
            ->route('partners-admin')
            ->with('status', 'You may edit only your communities')
            ->with('style', 'danger');
        }

        $group->name = $req['name'];
        $group->color = $req['color'];

        if ($group->save()) {   
            return redirect()
            ->route('partners-admin')
            ->with('status', 'Community Updated successfully!')
            ->with('style', 'success');
        } else {
            return redirect()
            ->route('partners-admin')
            ->with('status', 'Something ocurred while updating the Community')
            ->with('style', 'danger');
        }
    }
}
