<?php

namespace App\Http\Controllers\TeamTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamTypeService;

class AddTeamTypeController extends Controller
{
    private $teamTypeService;

    public function __construct (TeamTypeService $teamTypeService) {
        $this->teamTypeService = $teamTypeService;
    }

    public function create () {
        return view('types-admin.add-team-type');
    }

    public function store (Request $req) {
        $req->validate([
            'name' => ['required', 'max:255', 'string'],
            'sip' => ['required', 'max:100', 'numeric'],
            'central' => ['required', 'max:100', 'numeric'],
            'marketing' => ['required', 'max:100', 'numeric'],
            'support' => ['required', 'max:100', 'numeric']
        ]);

        if ($req['sip'] > 0 && $req['central'] > 0 && $req['marketing'] > 0 && $req['support'] > 0) {
            $data = [
                'name' => $req['name'],
                'sip' => $req['sip'],
                'central' => $req['central'],
                'marketing' => $req['marketing'],
                'support' => $req['support'],
                'user_id' => Auth::user()->id
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
            return back()->with('status', 'All the parameters must be greater than 0%')->with('style', 'danger');
        }
    }
}
