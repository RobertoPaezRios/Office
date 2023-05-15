<x-form-section submit="createTeam">
    <x-slot name="title">
        {{ __('Team Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a new team to collaborate with others on projects.') }}
    </x-slot>

    <x-slot name="form">
        
        <div class="col-span-6">
            <x-label class="mt-2" value="{{ __('Team Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">

                <div class="ml-4 leading-tight">
                    <div class="text-gray-900">{{ $this->user->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">  
            <x-label for="name" value="{{ __('Team Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autofocus />
            <x-input-error for="name" class="mt-2" />
            <x-label for="type" class="mt-2" value="{{ __('Team Type') }}"/>
            @php $types = \App\Models\TeamType::all(); @endphp
            <select id="type" name="type" wire:model.defer="state.type" class="block rounded mt-1 w-full">
                <option value="0">Choose a Type...</option>
                @foreach ($types as $key => $type) 
                    <option value="{{$type->id}}" @if($key == 0) selected @endif>{{ucfirst($type->name)}}</option>
                @endforeach
            </select>
            <x-input-error for="type" class="mt-2"/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ __('Create') }}
        </x-button>
    </x-slot>
</x-form-section>
