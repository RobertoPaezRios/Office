<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Your Partners') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-2" style="border-radius: 5px; border: 2px solid orange">
        PERSONAL PAGE
      </h2>
    </div>
  </x-slot>
  
  @if (session('status'))
    <x-banner message="{{session('status')}}" style="{{session('style')}}" />
  @endif

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        @livewire('owner-group')
      </div>
    </div>
  </div>

  <!-- FLOWBITE JS RESOURCE -->
  <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</x-app-layout>