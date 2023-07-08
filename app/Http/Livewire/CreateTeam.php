<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Team\TeamController;

use App\Services\Owners\OwnerGroupService;

class CreateTeam extends Component
{
    private $ownerGroupService;

    public function mount (
        OwnerGroupService $ownerGroupService
    ) {
        $this->ownerGroupService = $ownerGroupService;
    }

    public function render()
    {
        $communities = $this->ownerGroupService->listBelongingCommunities(Auth::user());

        return view('livewire.create-team', [
            'communities' => $communities
        ]);
    }
}
