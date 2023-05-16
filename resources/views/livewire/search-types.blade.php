<div>
    <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Types Admin') }}
        </h2>
        <a href="{{route('add-team-type')}}">
          <x-button class="bg-green-600 hover:bg-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>                  
            Add new Type
          </x-button>
        </a>
      </div>
    </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 overflow-hidden sm:rounded-lg">
        @if (session('status'))
          <x-banner message="{{session('status')}}" style="{{session('style')}}"/>
        @endif
        <div class="p-6">   
          <div class="relative overflow-x-auto bg-white shadow-md p-4 sm:rounded-lg">
            <!-- SEARCH FORM -->
            <div class="p-4 bg-white">
              <label for="table-search" class="sr-only">Search</label>
              <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" wire:model="search" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for Types">
              </div>
            </div>

            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                  <tr>
                      <th scope="col" class="px-6 py-3">
                          Name
                      </th>
                      <th scope="col" class="px-6 py-3">
                          S.I.P
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Central
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Marketing
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Support
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Edit
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Delete
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($types as $type)
                      <tr class="bg-white border-b hover:bg-gray-50">
                          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              {{ucfirst($type->name)}}
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{$type->sip}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{$type->central}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{$type->marketing}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{$type->support}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              <button class="hover:text-indigo-600">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                  </svg>                                  
                              </button>
                          </th>
                          <th scope="row" class="px-6 py-4">
                              <button class="hover:text-indigo-600">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                  </svg>                                  
                              </button>
                          </th>
                      </tr>
                  @endforeach
              </tbody>
            </table>
            <div class="mt-5">
              {{$types->links()}}
            </div>
          </div>
        </div>      
      </div>
    </div>
  </div>
</div>
