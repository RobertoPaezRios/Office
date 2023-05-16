<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Team\TeamTypeService;
use App\Models\TeamType;

class SearchTypes extends Component
{
    public $search;

    public function render()
    {
        $types = TeamType::where('user_id', Auth::user()->id)
        ->where('name', 'like', '%'. $this->search .'%')
        ->paginate(5);

        return view('livewire.search-types', ['types' => $types]);
    }
}
