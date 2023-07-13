<div>
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

    <!-- MODAL JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <div class="flex flex-wrap gap-4">
        <div class="h-52 w-40 p-4 bg-gray-100 shadow-lg rounded-lg overflow-hidden">
            <div class="flex justify-center">
                <div class="relative">
                    <img class="h-20 w-20 object-cover rounded-full border-2 border-gray-900" src="{{$owner->profile_photo_url}}" alt="">
                    <span class="top-0 left-14 absolute w-7 h-7 border-2 border-black bg-yellow-400 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crown" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z"></path>
                        </svg>      
                    </span>
                </div>
            </div>
            <div class="p-4 flex justify-center">
                <span class="text-sm truncate">
                    {{$owner->name}}
                </span>
            </div>
        </div>
        
        @if (count($links) > 0)
            @foreach ($links as $link) 
                <div class="h-52 w-40 p-4 bg-gray-100 shadow-lg rounded-lg overflow-hidden">
                    <div class="flex justify-center">
                        <div class="relative">
                            <img class="h-20 w-20 object-cover rounded-full border-2 border-gray-900" src="{{$partners[$link->user_id]->profile_photo_url}}" alt="">
                        </div>
                    </div>
                    <div class="p-4 flex justify-center">
                        <span class="text-sm truncate">
                            {{$partners[$link->user_id]->name}}
                        </span>
                    </div>
                    @if ($user->id === $owner->id)
                        <div class="">
                            <x-danger-button  wire:click="getDeleteId('{{$link->id}}')" data-bs-toggle="modal" data-bs-target="#confirmateModal" class="w-full rounded-full text-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>                          
                            </x-danger-button>
                        </div>
                    @endif
                </div>

                <!-- CONFIRMATE MODAL -->
                @if ($owner->id === $user->id)
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
                                        id="confirmateModalLabel">Confirmate Removing</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>                                                                  
                                    </button>
                                </div>
                                <div class="modal-body">Are you sure you want to remove this partner?, this will be permanent. </div>
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
                @endif
            @endforeach
        @endif
    </div>
</div>
