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
use Illuminate\Support\Facades\Auth;

class CreateTeam implements CreatesTeams
{
    private $teamTypeHistoryService;
    private $teamTypeService;

    public function __construct (
        TeamTypeHistoryService $teamTypeHistoryService,
        TeamTypeService $teamTypeService
    ) {
        $this->teamTypeHistoryService = $teamTypeHistoryService;
        $this->teamTypeService = $teamTypeService;    
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
            'type' => ['required'] 
        ])->validateWithBag('createTeam');

        if (Auth::user()->id != $this->teamTypeService->getOwner($input['type'])) {
            return redirect()->route('dashboard')->with('status', 'The team type selected is not yours!')->with('style', 'danger');
        }

        AddingTeam::dispatch($user);

        $user->switchTeam($team = $user->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,
        ]));

        //GUARDAR REGISTRO DE LA CREACION DEL EQUIPO
        $this->teamTypeHistoryService->setTeamTypeHistory($team->id, $input['type']);

        return $team;
    }
}
