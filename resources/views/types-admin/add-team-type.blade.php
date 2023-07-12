<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create Business Model') }}
      </h2>
    </div>
  </x-slot>

  @if (session('status'))
    <x-banner message="{{session('status')}}" style="{{session('style')}}"/>
  @endif

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="width:50%">
      <div class="bg-white overflow-hidden sm:rounded-lg p-6 text-center">
        <form action="{{route('store-team-type')}}" method="POST">
          @csrf
          <div class="flex justify-between gap-4">
            <div class="w-full">
              <x-label for="name" class="mb-2 text-left">Model Name:</x-label>
              <x-input type="text" name="name" id="name" class="w-full" placeholder="Type Name"/>
              <x-input-error for="name" class="mt-2"></x-input-error>
            </div>
            
            <div class="w-full">
              <x-label for="sip" class="text-left mb-2">% S.I.P:</x-label>
              <x-input type="number" step="0.01" name="sip" id="sip" class="w-full" placeholder="% S.I.P"/>
              <x-input-error for="sip" class="mt-2"></x-input-error>
            </div>
          </div>

          <div class="flex justify-between gap-4">
            <div class="w-full">
              <x-label for="central" class="mt-2 text-left">% Central:</x-label>
              <x-input type="number" step="0.01" name="central" id="central" class="w-full mt-2" placeholder="% Central"/>
              <x-input-error for="central"></x-input-error>
            </div>
            
            <div class="w-full">
              <x-label for="marketing" class="mt-2 text-left">% Marketing:</x-label>
              <x-input type="number" step="0.01" name="marketing" id="marketing" class="w-full mt-2" placeholder="% Marketing"/>
              <x-input-error for="marketing"></x-input-error>
            </div>
          </div>

          <div class="flex justify-between gap-4">
            <div class="w-full">
              <x-label for="support" class="mt-2 text-left">% Support:</x-label>
              <x-input type="number" step="0.01" name="support" id="support" class="w-full mt-2" placeholder="% Support"/>
              <x-input-error for="support"></x-input-error>
            </div>
            <div class="w-full">
              <x-label for="community" class="mt-2 text-left">Community:</x-label>
              <select class="rounded w-full mt-2 border shadow-sm border-gray-200 text-gray-500" name="community" id="community">
                @foreach ($communities as $community)
                  <option value="{{$community->uuid}}">{{$community->name}}</option>
                @endforeach
              </select>
              <x-input-error for="community"></x-input-error>
            </div>
          </div>
          
          <div class="flex justify-end">
            <x-button class="mt-5 bg-green-600 hover:bg-green-700">Create Model</x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>