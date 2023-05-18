@php 
$types = \App\Models\TeamType::all(); 
$myTeam = \App\Models\Team::find(\Illuminate\Support\Facades\Auth::user()->current_team_id);
@endphp

<x-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-label value="{{ __('Team Owner') }}" />
            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div class="text-gray-900">{{ $team->owner->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Team Name') }}" />

            <x-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $team)" />

            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Team Type -->
        @php 
            if ($team->personal_team == 0) {
                $myTypes = \App\Models\TeamTypeHistory::where('team_id', $team->id)->orderBy('created_at', 'desc')->get(); 
                $actualType = \App\Models\TeamType::find($myTypes[0]->type_id);
                $user = Illuminate\Support\Facades\Auth::user();
                $types = \App\Models\TeamType::where('user_id', $user->id)->get();
            }
        @endphp
        @if ($team->personal_team == 0)
        <div class="col-span-6 sm:col-span-4">
            <x-label for="type" class="mt-2" value="{{ __('Team Type') }}"/>
            <span class="mt-2 text-gray-500 text-sm">Actual Team Type: <span class="font-bold text-gray-900">{{ucfirst($actualType->name)}}</span></span>

            <select name="type" id="type" wire:model.defer="state.type" class="block rounded mt-1 w-full">
                <option value="0">Select the new type...</option>
                @foreach ($types as $key => $type)
                    @if ($type->id != $actualType->id)
                        <option value="{{$type->id}}">{{ucfirst($type->name)}}</option>
                    @endif
                @endforeach
            </select>
            <x-input-error for="type" class="mt-2"/>
        </div>@endif
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    @endif
</x-form-section>
