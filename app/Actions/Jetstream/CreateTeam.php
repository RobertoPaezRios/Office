<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;
use App\Services\Team\TeamTypeHistoryService;
use App\Services\Team\TeamTypeService;
use App\Services\Owners\OwnerGroupService;
use App\Services\Owners\OwnerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateTeam implements CreatesTeams
{
    private $teamTypeHistoryService;
    private $teamTypeService;
    private $ownerGroupService;
    private $ownerService;

    public function __construct (
        TeamTypeHistoryService $teamTypeHistoryService,
        TeamTypeService $teamTypeService,
        OwnerGroupService $ownerGroupService,
        OwnerService $ownerService
    ) {
        $this->teamTypeHistoryService = $teamTypeHistoryService;
        $this->teamTypeService = $teamTypeService;
        $this->ownerGroupService = $ownerGroupService;    
        $this->ownerService = $ownerService;
    }

    /**
     * Validate and create a new team for the given user.
     *
     * @param  array<string, string>  $input
     */
    public function create(User $user, array $input) {
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],     
            'type' => ['required', 'string', 'min:1'],
            'community' => ['required', 'string', 'min:1'] 
        ]);
        
        $communities = $this->ownerGroupService->listBelongingCommunities(Auth::user());

        if (!$communities) {
            return 
            redirect()
            ->route('dashboard')
            ->with('status', '0 communities found!')
            ->with('style', 'danger');
        }

        if (is_null($this->teamTypeService->getTypeByUuid($input['type']))) {
            return 
            redirect()
            ->route('dashboard')
            ->with('status', 'The team type selected does not exist!')
            ->with('style', 'danger');
        }
        
        $cont = 0;
        foreach ($communities as $community) {
            if ($this->teamTypeService->getTypeByUuid($input['type'])->group_id == $community->id) {
                break;
            }
            $cont++;
        }

        if ($cont >= count($communities)) {
            return 
            redirect()
            ->route('dashboard')
            ->with('status', 'The team type selected does not belong to you!')
            ->with('style', 'danger');
        }

        if (is_null($this->ownerGroupService->getGroupByUuid($input['community']))) {
            return 
            redirect()
            ->route('dashboard')
            ->with('status', 'The community selected does not exist!')
            ->with('style', 'danger');
        }

        if (Auth::user()->id != $this->ownerGroupService->getOwnerByGroupUuid($input['community'])->id && count($this->ownerService->belongsTo(Auth::user()->id, $this->ownerGroupService->getOwnerByGroupUuid($input['community'])->id)) == 0) {
            return 
            redirect()
            ->route('dashboard')
            ->with('status', 'The community selected is not yours')
            ->with('style', 'danger');
        } 
        $communityOwner = User::find($this->ownerGroupService->getOwnerByGroupUuid($input['community']));

        $input['type'] = $this->teamTypeService->getTypeByUuid($input['type'])->id;
        $input['community'] = $this->ownerGroupService->getGroupByUuid($input['community'])->id;

        AddingTeam::dispatch($communityOwner[0]);

        $user->switchTeam($team = $communityOwner[0]->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,
            'group_id' => $input['community']
        ]));

        //GUARDAR REGISTRO DE LA CREACION DEL EQUIPO
        $this->teamTypeHistoryService->setTeamTypeHistory($team->id, $input['type']);

        return $team;
    }
}
