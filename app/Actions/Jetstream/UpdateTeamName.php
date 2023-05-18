<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamTypeHistoryService;
use App\Services\Team\TeamTypeService;

class UpdateTeamName implements UpdatesTeamNames
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
     * Validate and update the given team's name.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, Team $team, array $input)
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'name' => ['string', 'max:255'],
            'type' => ['numeric']
        ])->validateWithBag('updateTeamName');

        $team->forceFill([
            'name' => $input['name']
        ])->save();

        //CHECK IF THE NEW TYPE IS USER PROPERTY
        if (!empty($input['type'])) {
            if (Auth::user()->id != $this->teamTypeService->getOwner($input['type'])) {
                return redirect()->route('dashboard')->with('status', 'The team type selected is not yours!')->with('style', 'danger');
            }
        }

        if ($team->personal_team == 0) {   
            //GUARDAR REGISTRO EN TEAM TYPE HISTORY
            if (isset($input['type'])) {
                if ($input['type'] > 0)
                $this->teamTypeHistoryService->setTeamTypeHistory($team->id, $input['type']);
            }
        }
    }
}
