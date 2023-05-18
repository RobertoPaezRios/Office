<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('teams.update-team-name-form', ['team' => $team, 'types' => $types])

            <div class="bg-white shadow-lg mt-2 text-center rounded mx-auto sm:px-6 lg:px-8">
                <div class="py-2">

                    <h4 class="font-semibold">
                        Team Historic
                    </h4>

                    @foreach ($types as $type) 
                        <span>{{$type['name']}} | {{$type['created_at']}}</span><br>
                    @endforeach
                </div>
            </div>

            @livewire('teams.team-member-manager', ['team' => $team, 'type' => $types])

            {{--@if (Gate::check('delete', $team) && ! $team->personal_team)
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('teams.delete-team-form', ['team' => $team])
                </div>
            @endif--}}
        </div>
    </div>
</x-app-layout>
