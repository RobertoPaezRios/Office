<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Update Team Type') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="width:50%">
      <div class="bg-white overflow-hidden sm:rounded-lg p-6 text-center">
        <form action="{{route('update.update-team-type')}}" method="POST">
          @csrf
          <x-input type="hidden" name="id" value="{{$type->id}}"/>

          <div class="flex justify-between gap-4">
            <div class="w-full">
              <x-label for="name" class="mb-2 text-left">Type Name:</x-label>
              <x-input type="text" name="name" value="{{$type->name}}" id="name" class="w-full" placeholder="Type Name"/>
              <x-input-error for="name" class="mt-2"></x-input-error>
            </div>
            
            <div class="w-full">
              <x-label for="sip" class="text-left mb-2">% S.I.P:</x-label>
              <x-input type="number" name="sip" id="sip" value="{{$type->sip}}" class="w-full" placeholder="% S.I.P"/>
              <x-input-error for="sip" class="mt-2"></x-input-error>
            </div>
          </div>

          <div class="flex justify-between gap-4">
            <div class="w-full">
              <x-label for="central" class="mt-2 text-left">% Central:</x-label>
              <x-input type="number" name="central" id="central" value="{{$type->central}}" class="w-full mt-2" placeholder="% Central"/>
              <x-input-error for="central"></x-input-error>
            </div>
            
            <div class="w-full">
              <x-label for="marketing" class="mt-2 text-left">% Marketing:</x-label>
              <x-input type="number" name="marketing" id="marketing" value="{{$type->marketing}}" class="w-full mt-2" placeholder="% Marketing"/>
              <x-input-error for="marketing"></x-input-error>
            </div>
          </div>

          <div class="flex justify-between gap-4">
            <div class="w-full">
              <x-label for="support" class="mt-2 text-left">% Support:</x-label>
              <x-input type="number" name="support" id="support" value="{{$type->support}}" class="w-full mt-2" placeholder="% Support"/>
              <x-input-error for="support"></x-input-error>
            </div>
            <div class="w-full"></div>
          </div>
          
          <div class="flex justify-end">
            <x-button class="mt-5 bg-yellow-400 hover:bg-yellow-500 gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
              </svg>              
              Update Type
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>