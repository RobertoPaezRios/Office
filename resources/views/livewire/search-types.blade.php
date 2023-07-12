<div>
  <!-- MODAL CSS -->
  <style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1060;
        display: none;
        width: 100%;
        height: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        outline: 0
    }

    .modal-dialog {
        position: relative;
        width: auto;
        margin: .5rem;
        pointer-events: none
    }

    .modal.fade .modal-dialog {
        transition: transform .3s ease-out;
        transform: translate(0, -50px)
    }

    @media (prefers-reduced-motion:reduce) {
        .modal.fade .modal-dialog {
            transition: none
        }
    }

    .modal.show .modal-dialog {
        transform: none
    }

    .modal.modal-static .modal-dialog {
        transform: scale(1.02)
    }

    .modal-dialog-scrollable {
        height: calc(100% - 1rem)
    }

    .modal-dialog-scrollable .modal-content {
        max-height: 100%;
        overflow: hidden
    }

    .modal-dialog-scrollable .modal-body {
        overflow-y: auto
    }

    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 1rem)
    }

    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: .3rem;
        outline: 0
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: #000
    }

    .modal-backdrop.fade {
        opacity: 0
    }

    .modal-backdrop.show {
        opacity: .5
    }

    .modal-header {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #dee2e6;
        border-top-left-radius: calc(.3rem - 1px);
        border-top-right-radius: calc(.3rem - 1px)
    }

    .modal-header .btn-close {
        padding: .5rem .5rem;
        margin: -.5rem -.5rem -.5rem auto
    }

    .modal-title {
        margin-bottom: 0;
        line-height: 1.5
    }

    .modal-body {
        position: relative;
        flex: 1 1 auto;
        padding: 1rem
    }

    .modal-footer {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        padding: .75rem;
        border-top: 1px solid #dee2e6;
        border-bottom-right-radius: calc(.3rem - 1px);
        border-bottom-left-radius: calc(.3rem - 1px)
    }

    .modal-footer>* {
        margin: .25rem
    }

    @media (min-width:576px) {
        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto
        }

        .modal-dialog-scrollable {
            height: calc(100% - 3.5rem)
        }

        .modal-dialog-centered {
            min-height: calc(100% - 3.5rem)
        }

        .modal-sm {
            max-width: 300px
        }
    }

    @media (min-width:992px) {

        .modal-lg,
        .modal-xl {
            max-width: 800px
        }
    }

    @media (min-width:1200px) {
        .modal-xl {
            max-width: 1140px
        }
    }

    .modal-fullscreen {
        width: 100vw;
        max-width: none;
        height: 100%;
        margin: 0
    }

    .modal-fullscreen .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0
    }

    .modal-fullscreen .modal-header {
        border-radius: 0
    }

    .modal-fullscreen .modal-body {
        overflow-y: auto
    }

    .modal-fullscreen .modal-footer {
        border-radius: 0
    }

    @media (max-width:575.98px) {
        .modal-fullscreen-sm-down {
            width: 100vw;
            max-width: none;
            height: 100%;
            margin: 0
        }

        .modal-fullscreen-sm-down .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0
        }

        .modal-fullscreen-sm-down .modal-header {
            border-radius: 0
        }

        .modal-fullscreen-sm-down .modal-body {
            overflow-y: auto
        }

        .modal-fullscreen-sm-down .modal-footer {
            border-radius: 0
        }
    }

    @media (max-width:767.98px) {
        .modal-fullscreen-md-down {
            width: 100vw;
            max-width: none;
            height: 100%;
            margin: 0
        }

        .modal-fullscreen-md-down .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0
        }

        .modal-fullscreen-md-down .modal-header {
            border-radius: 0
        }

        .modal-fullscreen-md-down .modal-body {
            overflow-y: auto
        }

        .modal-fullscreen-md-down .modal-footer {
            border-radius: 0
        }
    }

    @media (max-width:991.98px) {
        .modal-fullscreen-lg-down {
            width: 100vw;
            max-width: none;
            height: 100%;
            margin: 0
        }

        .modal-fullscreen-lg-down .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0
        }

        .modal-fullscreen-lg-down .modal-header {
            border-radius: 0
        }

        .modal-fullscreen-lg-down .modal-body {
            overflow-y: auto
        }

        .modal-fullscreen-lg-down .modal-footer {
            border-radius: 0
        }
    }

    @media (max-width:1199.98px) {
        .modal-fullscreen-xl-down {
            width: 100vw;
            max-width: none;
            height: 100%;
            margin: 0
        }

        .modal-fullscreen-xl-down .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0
        }

        .modal-fullscreen-xl-down .modal-header {
            border-radius: 0
        }

        .modal-fullscreen-xl-down .modal-body {
            overflow-y: auto
        }

        .modal-fullscreen-xl-down .modal-footer {
            border-radius: 0
        }
    }

    @media (max-width:1399.98px) {
        .modal-fullscreen-xxl-down {
            width: 100vw;
            max-width: none;
            height: 100%;
            margin: 0
        }

        .modal-fullscreen-xxl-down .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0
        }

        .modal-fullscreen-xxl-down .modal-header {
            border-radius: 0
        }

        .modal-fullscreen-xxl-down .modal-body {
            overflow-y: auto
        }

        .modal-fullscreen-xxl-down .modal-footer {
            border-radius: 0
        }
    }

  </style>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
  integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
  integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
        {{ __('Business Models') }}
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight p-2" style="border-radius: 5px; border: 2px solid orange">
        PERSONAL PAGE
      </h2>
    </div>
  </x-slot>
  <!-- FALTA PONER TEMPORIZADOR AL BANNER PARA QUE SE AUTOELIMINA Y NO INTERFIERA CON EL MODAL -->
    @if (session('status'))
        <div id="banner" style="">
            <x-banner message="{{session('status')}}" style="{{session('style')}}"/>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <script>
        setTimeout (() => {
            $("#banner").fadeOut(1500);
        }, 3000);
    </script>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 overflow-hidden sm:rounded-lg">
        <div class="p-6">   
          <div class="relative overflow-x-auto bg-white shadow-md p-4 sm:rounded-lg">
            <!-- SEARCH FORM -->
            <div class="p-4 bg-white flex justify-between">
              <label for="table-search" class="sr-only">Search</label>
              <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" wire:model="search" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for Business Models">
              </div>
              <!-- ADD TYPE BUTTON -->
              <a href="{{route('add-team-type')}}">
                <x-button class="bg-green-600 hover:bg-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>                  
                    Add new Business Model
                </x-button>
              </a>
            </div>

            <table class="w-full text-sm text-gray-500">
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
                          Community
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Edit
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Delete
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Nº Sales
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($types as $key => $community)
                    @foreach ($community as $type) 
                      <tr class="bg-white border-b hover:bg-gray-50 text-center">
                          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              {{ucfirst($type->name)}}
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{number_format($type->sip, 2, ',', '.')}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{number_format($type->central, 2, ',', '.')}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{number_format($type->marketing, 2, ',', '.')}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              {{number_format($type->support, 2, ',', '.')}} %
                          </th>
                          <th scope="row" class="px-6 py-4">
                              <div class="rounded-full py-1 text-white text-md font-bold text-gray-900" style="background-color: {{$communities[$type->id]->color}}">
                                {{$communities[$type->id]->name}}
                              </div>
                          </th>
                          <th scope="row" class="px-6 py-4">
                            @if (count($sales) > 0)  
                                @if ($sales[$type->id]['sales'] > 0 || $sales[$type->id]['teams'] > 0)
                                    <x-button class="hover:bg-gray-800" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>                                        
                                    </x-button>
                                @else
                                    <a href="{{route('update-team-type', $type->uuid)}}">
                                        <x-button class="bg-yellow-400 hover:bg-yellow-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>                                 
                                        </x-button>
                                    </a>
                                @endif
                            @endif
                          </th>
                          <th scope="row" class="px-6 py-4">
                            @if (count($sales) > 0)
                                @if ($sales[$type->id]['sales'] > 0 || $sales[$type->id]['teams'] > 0)
                                    <x-button class="hover:bg-gray-800" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>                                                      
                                    </x-button>
                                @else
                                    <x-danger-button class="hover:bg-red-700" wire:click="setDeleteId({{$type->id}})" data-bs-toggle="modal" data-bs-target="#confirmateModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>                                  
                                    </x-danger-button>
                                @endif
                            @else
                                <x-danger-button class="hover:bg-red-700" wire:click="destroy()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>                                  
                                </x-danger-button>
                            @endif
                            
                            <!-- CONFIRMATE MODAL -->
                            <div class="modal fade" wire:ignore.self id="confirmateModal" tabindex="-1" aria-labelledby="confirmateModal" aria-hidden="true" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="bg-red-200 rounded-full p-2 text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                </svg>                                              
                                            </div>
                                            <h1 class="modal-title ml-2 text-gray-900 font-bold"
                                                id="confirmateModalLabel">Confirmate Deleting</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>                                                                  
                                            </button>
                                        </div>
                                        <div class="modal-body">Are you sure you want to delete this register?, this will be permanent. </div>
                                        <div class="modal-footer">
                                            <x-button type="button" data-bs-dismiss="modal">
                                                Close
                                            </x-button>
                                            <x-danger-button wire:click="destroy()" type="button" data-bs-dismiss="modal">
                                                Delete
                                            </x-danger-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </th>
                          <th scope="row" class="px-6 py-4">
                            {{$sales[$type->id]['sales']}}
                          </th>
                      </tr>
                      @endforeach
                  @endforeach
              </tbody>
            </table>
            {{--<div class="mt-5">
              {{$community->links()}}
            </div>--}}
          </div>
        </div>      
      </div>
    </div>
  </div>
</div>
