<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Create Group') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-2" style="border-radius: 5px; border: 2px solid orange">
        PERSONAL PAGE
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="w-2/4 mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="">
          <h3 class="font-bold text-xl text-center">
            Create Group
          </h3>
          <hr class="mt-4 mb-4">
          <form action="{{route('create-group.store')}}" class="w-full mx-auto shadow-xl p-6 rounded-lg" method="POST">
            @csrf
            <div class="w-full">
              <x-label for="name" class="mb-2 text-left">Group Name:</x-label>
              <x-input type="text" name="name" id="name" class="w-full" placeholder="Group Name"/>
              <x-input-error for="name" class="mt-2"></x-input-error>
            </div>
            
            <x-button class="mt-5 bg-green-600 hover:bg-green-700">Create Group</x-button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>