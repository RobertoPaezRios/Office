<?php

namespace App\Http\Controllers\TeamTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamTypeService;
use App\Services\Owners\OwnerGroupService;
use App\Services\Owners\OwnerService;

class AddTeamTypeController extends Controller
{
    private $teamTypeService;
    private $ownerGroupService;
    private $ownerService;

    public function __construct (
        TeamTypeService $teamTypeService,
        OwnerGroupService $ownerGroupService,
        OwnerService $ownerService
    ) {
        $this->teamTypeService = $teamTypeService;
        $this->ownerGroupService = $ownerGroupService;        
        $this->ownerService = $ownerService;
    }

    public function create () {
        $circles = $this->ownerGroupService->listOwnerGroupByUserId(Auth::user()->id);
        $links = $this->ownerService->listGroupsByMemberId(Auth::user()->id);

        if (count($links) > 0) {
            foreach ($links as $link) {
                $groups [] = $this->ownerGroupService->getGroup($link->group_id);
            }

            foreach ($groups as $group) {
                $communities[$group->id] = $group;
            }
        }

        foreach ($circles as $circle) {
            $communities [$circle->id] = $circle;
        }

        return view('types-admin.add-team-type', [
            'communities' => isset($communities) ? $communities : $circles
        ]);
    }

    public function store (Request $req) {
        $req->validate([
            'name' => ['required', 'max:255', 'string'],
            'sip' => ['required', 'max:100', 'numeric'],
            'central' => ['required', 'max:100', 'numeric'],
            'marketing' => ['required', 'max:100', 'numeric'],
            'support' => ['required', 'max:100', 'numeric'],
            'community' => ['required', 'min:1', 'numeric']
        ]);

        
        if ($req['sip'] > 0 && $req['central'] > 0 && $req['marketing'] > 0 && $req['support'] > 0 && $req['community'] > 0) {
            $types = $this->teamTypeService->listTypesByGroupId ($req['community']);
            
            foreach ($types as $type) {
                if ($type->name === $req['name']) {
                    return back()
                    ->with('status', $req['name'] . ' name is already in use, try again!')
                    ->with('style', 'danger');
                }
            }

            $data = [
                'name' => $req['name'],
                'sip' => $req['sip'],
                'central' => $req['central'],
                'marketing' => $req['marketing'],
                'support' => $req['support'],
                'user_id' => Auth::user()->id,
                'group_id' => $req['community']
            ];

            if ($this->teamTypeService->setType($data)) {
                return redirect()
                ->route('types-admin')
                ->with('status', 'New Team Type ' . ucfirst($req['name']) . ' created successfully!')
                ->with('style', 'success');
            } else {
                return redirect()
                ->route('types-admin')
                ->with('status', 'Something ocurred while creating the new team!')
                ->with('style', 'danger');
            }
        } else {       
            return back()->with('status', 'All the parameters must be greater than 0%')->with('style', 'danger');
        }
    }
}
