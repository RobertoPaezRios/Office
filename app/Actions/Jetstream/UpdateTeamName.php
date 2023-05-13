<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;

use App\Services\Team\TeamTypeHistoryService;

class UpdateTeamName implements UpdatesTeamNames
{
    private $teamTypeHistoryService;

    public function __construct (TeamTypeHistoryService $teamTypeHistoryService) {
        $this->teamTypeHistoryService = $teamTypeHistoryService;
    }

    /**
     * Validate and update the given team's name.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, Team $team, array $input): void
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'name' => ['string', 'max:255'],
            'type' => ['numeric']
        ])->validateWithBag('updateTeamName');

        $team->forceFill([
            'name' => $input['name']
        ])->save();

        if ($team->personal_team == 0) {   
            //GUARDAR REGISTRO EN TEAM TYPE HISTORY
            if (isset($input['type'])) {
                if ($input['type'] > 0)
                $this->teamTypeHistoryService->setTeamTypeHistory($team->id, $input['type']);
            }
        }
    }
}
