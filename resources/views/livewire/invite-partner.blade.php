<div> 
    <div class="w-full">
        <div class="flex gap-4 w-full">
            <div class="w-full">
                <x-label for="email">Email:</x-label>
                <x-input type="email" wire:model="email" name="email" class="mt-2 w-full" placeholder="Enter email" />
                <x-input-error for="email"></x-input-error>
            </div>
            <div class="flex justify-end items-end">
                <x-button type="submit" class="text-center h-10" wire:click="send()">Send</x-button>
            </div>
        </div>
    </div>
    @if (count($invitations) > 0)
        <hr class="my-4">
        <h4 class="font-bold text-md my-2">
            Pending Invitations
        </h4>
        @foreach ($invitations as $invitation)
            <div class="flex flex-wrap justify-between">
                <div>
                    <span class="">
                        {{$invitation->email}}
                    </span>
                    <span class="ml-4 text-sm text-gray-500">
                        {{$invitation->created_at}}
                    </span>
                </div>
                <span wire:click="cancel('{{$invitation->token}}')" class="text-red-500 underline cursor-pointer">
                    cancel
                </span>
            </div>
        @endforeach
    @endif
</div>
