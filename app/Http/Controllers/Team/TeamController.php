<?php

namespace App\Http\Controllers\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Services\Owners\OwnerGroupService;

class TeamController extends Controller
{
    private $ownerGroupService;

    public function __construct (
        OwnerGroupService $ownerGroupService
    ) {
        $this->ownerGroupService = $ownerGroupService;
    }

    public function listCommunities () {
        return $this->ownerGroupService->listBelongingCommunities(Auth::user());
    }
}
