<?php

namespace App\Http\Controllers\TeamTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteTeamTypeController extends Controller
{
    public function destroy ($id) {
        return 'hellowlrd' . $id;
    }
}
