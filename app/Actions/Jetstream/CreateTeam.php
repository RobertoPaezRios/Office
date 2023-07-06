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
    public function create(User $user, array $input)
    {

        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],     
            'type' => ['required', 'numeric'],
            'community' => ['required', 'numeric', 'min:1'] 
        ])->validateWithBag('createTeam');

        if (Auth::user()->id != $this->teamTypeService->getOwner($input['type'])) {
            return 
            redirect()
            ->route('dashboard')
            ->with('status', 'The team type selected is not yours!')
            ->with('style', 'danger');
        }

        if (Auth::user()->id != $this->ownerGroupService->getOwnerByGroupId($input['community'])->id && count($this->ownerService->belongsTo(Auth::user()->id, $input['community'])) == 0) {
            return 
            redirect()
            ->route('dashboard')
            ->with('status', 'The community selected is not yours')
            ->with('style', 'danger');
        } 

        $communityOwner = User::find($this->ownerGroupService->getOwnerByGroupId($input['community']));

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
