<?php

namespace App\Http\Controllers\TeamTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Services\Team\TeamTypeService;
use App\Services\Owners\OwnerGroupService;
use App\Services\Owners\OwnerService;
use App\Services\Team\TeamService;

class AddTeamTypeController extends Controller
{
    private $teamTypeService;
    private $ownerGroupService;
    private $ownerService;
    private $teamService;
    private $communities;

    public function __construct (
        TeamTypeService $teamTypeService,
        OwnerGroupService $ownerGroupService,
        OwnerService $ownerService,
        TeamService $teamService
    ) {
        $this->teamTypeService = $teamTypeService;
        $this->ownerGroupService = $ownerGroupService;        
        $this->ownerService = $ownerService;
        $this->teamService = $teamService;
    }

    public function create () {
        $team = $this->teamService->getTeam(Auth::user()->current_team_id);

        if (!$this->teamService->isPersonal($team)) {
            return redirect()
            ->route('dashboard')
            ->with('status', 'You can only access this page from your personal page')
            ->with('style', 'danger');
        }

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
        $team = $this->teamService->getTeam(Auth::user()->current_team_id);

        if (!$this->teamService->isPersonal($team)) {
            return redirect()
            ->route('dashboard')
            ->with('status', 'You can only access this page from your personal page')
            ->with('style', 'danger');
        }

        $req->validate([
            'name' => ['required', 'max:255', 'string'],
            'sip' => ['required', 'max:100', 'numeric'],
            'central' => ['required', 'max:100', 'numeric'],
            'marketing' => ['required', 'max:100', 'numeric'],
            'support' => ['required', 'max:100', 'numeric'],
            'community' => ['required', 'min:1', 'string']
        ]);
        
        $user = Auth::user();
        $circles = $this->ownerGroupService->listOwnerGroupByUserId($user->id);
        $links = $this->ownerService->listGroupsByMemberId($user->id);

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

        if ($req['sip'] > 0 && $req['central'] > 0 && $req['marketing'] > 0 && $req['support'] > 0 && strlen($req['community']) > 0) {
            $types = $this->teamTypeService->listTypesByGroupId ($req['community']);

            $cont = 0;
            foreach ($communities as $community) {
                if ($community->uuid === $req['community']) {
                    if ($user->id == $this->ownerGroupService->getGroupByUuid($req['community'])->user_id) {
                        $req['community'] = $this->ownerGroupService->getGroupByUuid($req['community'])->id;
                    } 
                    
                    $members = $this->ownerGroupService->listMyMembers($community->id);

                    if (count($members) > 0) {
                        foreach ($members as $member) {
                            if ($member->user_id == $user->id) {
                                $req['community'] = $this->ownerGroupService->getGroupByUuid($req['community'])->id;
                                break;
                            }
                        }
                    }

                    break;
                }

                $cont += 1;
            }

            if ($cont >= count($communities)) {
                return back()
                ->with('status', "The community selected does not belong to your user")
                ->with('style', 'danger');
            }

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
                'user_id' => $user->id,
                'group_id' => $req['community'],
                'uuid' => hash('sha256', Str::random(60))
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
            return back()
            ->with('status', 'All the parameters must be greater than 0%')
            ->with('style', 'danger');
        }
    }
}
