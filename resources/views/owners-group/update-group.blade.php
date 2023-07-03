<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
        {{ __('Update Community') }}
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight p-2" style="border-radius: 5px; border: 2px solid orange">
        PERSONAL PAGE
      </h2>
    </div>
  </x-slot>

  <!-- CDN IRO JS (COLOR PICKER) -->
  <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5"></script>

  @if (!$status)
    <x-banner message="This community can't be updated" style="danger" />
  @endif

  <div class="py-12">
    <div class="w-2/4 mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-2 overflow-hidden shadow-xl sm:rounded-lg">
        <h3 class="font-semibold text-lg text-center">
          Update Community
        </h3><hr class="mt-2 mb-2">
        <div class="">
          <div class="mb-4">
            <h4 class="font-semibold text-md">
              Community Owner:
            </h4>
            <div class="flex items-center mt-2">
              <img class="w-12 h-12 rounded-full object-cover" src="{{ $owner->profile_photo_url }}" alt="{{ $owner->name }}">
              <div class="ml-4 leading-tight">
                  <div class="text-gray-900">{{ $owner->name }}</div>
                  <div class="text-gray-700 text-sm">{{ $owner->email }}</div>
              </div>
            </div>
          </div>
          <form action="{{route('update-community.update', $id)}}" method="POST">
            @csrf
            <div class="flex flex justify-between flex-wrap gap-1">
              <div class="w-full">
                <x-label for="name" class="text-left mb-2">Name: </x-label>
                <x-input type="text" name="name" id="name" class="w-full" placeholder="Name:" value="{{$name}}"/>
                <x-input-error for="name" class="mt-2"></x-input-error>
              </div>
              <div class="w-full flex gap-5 mt-3">
                <div id="picker"></div>
                <div class="w-1/4">
                  <x-label for="color" class="text-left mb-2">Color:</x-label>
                  <x-input type="text" name="color" id="color" class="w-full" placeholder="#" value="{{$color}}"/>
                  <x-input-error for="color" class="mt-2"></x-input-error>
                </div>
              </div>
            </div>

            <div class="mt-4 flex justify-end">
              @if ($status)
                <x-button class="bg-yellow-400 hover:bg-yellow-500 focus:bg-yellow-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                  </svg>
                  <span class="ml-4">
                    update                
                  </span>
                </x-button>
              @else 
                <x-button class="hover:bg-gray-800 bg-gray-800" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                  </svg>                  
                </x-button>
              @endif 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const input = document.getElementById('color');

    var colorPicker = new iro.ColorPicker('#picker', {
      width: 100,
      color: @json($color)
    });

    colorPicker.on('color:change', function (color) {
      input.value = color.hexString;
    });

    input.addEventListener('change', (event) => {
      colorPicker.color.hexString = input.value;
    });
  </script>
</x-app-layout>