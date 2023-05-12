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

class CreateTeam implements CreatesTeams
{
    private $teamTypeHistoryService;

    public function __construct (TeamTypeHistoryService $teamTypeHistoryService) {
        $this->teamTypeHistoryService = $teamTypeHistoryService;
    }

    /**
     * Validate and create a new team for the given user.
     *
     * @param  array<string, string>  $input
     */
    public function create(User $user, array $input): Team
    {

        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],     
            'type' => ['required'] 
        ])->validateWithBag('createTeam');

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
