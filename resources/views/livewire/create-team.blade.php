<div>
    <x-label for="community" value="{{__('Team Community')}}"/>
    <select class="block rounded mb-2 mt-1 w-full" wire:model.defer="state.community">
        <option value="0">Choose the Community...</option>
        @foreach ($communities as $community)
            <option value="{{$community->id}}">{{$community->name}}</option>
        @endforeach
    </select>
    <x-input-error for="community" class="mt-2 mb-2" />
</div>
