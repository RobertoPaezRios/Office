<x-app-layout>
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
        {{ __('Your Communities') }}
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