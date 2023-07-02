<div>
    {{--<div class="py-14 px-14 flex flex-wrap justify-items-center content-center justify-relative gap-6">
        <div class="w-full flex justify-center gap-6 bg-gray-100 rounded-lg p-6 text-center">
            <span class="font-bold text-xl my-auto mt-2 text-gray-900 absolute">
                {{$group->name}}
            </span>
            <span>
                <div class="flex -space-x-4">
                    @foreach ($members as $key => $member)
                        @if ($key > 3) @break @endif
                        <img class="w-10 h-10 border-2 border-white rounded-full" src="{{$member->profile_photo_url}}" alt="">
                    @endforeach
                    @if (count($members) >= 5)
                        <span class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full">
                            +{{count($members) - 4}}
                        </span>
                    @endif                      
                </div>
            </span>
            <span class="my-auto text-end w-full">
                <x-button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                    </svg>                     
                </x-button>
            </span>
        </div>
        <div class="flex flex-wrap gap-6">  
            @foreach ($members as $key => $member) 
            <div class="h-96 w-64 bg-gray-100 sm:rounded-lg place-items-center grid">
                <div class="relative">  
                    <img class="rounded-full object-cover w-40 h-40 shadow-xl" src="{{$member->profile_photo_url}}" alt="">
                    @if ($key < 1)
                        <span class="top-0 absolute w-10 h-10 bg-yellow-400 border-2 border-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-6 h-6 mx-auto mt-1.5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z"></path>
                            </svg>
                        </span>
                        @endif
                    </div>
                    <div class="text-center">
                        <h3 class="text-gray-900 text-xl font-bold">{{$member['name']}}</h3>
                    <h4 class="text-gray-500 text-sm">{{$member['email']}}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>--}}
    <div class="p-4">
        <div class="flex justify-between">
            <h3 class="font-semibold text-lg my-auto">
                Current Communities
            </h3>
            <a href="{{route('create-group')}}">
                <x-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="ml-2">
                        ADD NEW Community                  
                    </span>
                </x-button>
            </a>
        </div>
        <hr class="mt-4">
        <div class="w-full mt-4">
            @if (count($groups) > 0)
                <div class="flex flex-wrap items-center gap-4">
                    @foreach ($groups as $group) 
                        <div class="w-64 h-72 rounded-lg shadow-xl border hover:opacity-75 transition duration-300 hover:cursor-pointer">
                            <div class="bg-indigo-600 rounded-t-lg h-20 p-3 text-white truncate">
                                <div class="flex justify-between">
                                    <span class="font-bold text-lg">
                                        {{$group->name}}
                                    </span>
                                    <button id="settingsButton" data-dropdown-toggle="settings" class="rounded-lg px-1 hover:bg-indigo-700 transition duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>                                                                                                                                                                        
                                    </button>
                                </div>
                                <div class="text-md overflow-hidden text-ellipsis">
                                    <span class="my-auto">
                                        {{$owners[$group->id]->name}}
                                    </span>
                                </div>
                            </div>
                            <div class="w-full h-52 p-3 overflow-y-auto text-ellipsis">
                                <div class="w-full h-20 bg-gray-100 shadow-md rounded-lg p-2 flex justify-between gap-4">
                                    <div class="flex gap-2 my-auto ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                        </svg> 
                                        <span>Teams</span>                                     
                                    </div>
                                    <div class="my-auto mr-4">
                                        {{count($teams[$group->id])}}                                      
                                    </div>
                                </div>
                                <div class="w-full h-20 bg-gray-100 shadow-md rounded-lg p-2 flex justify-between gap-4 mt-4">
                                    <div class="flex gap-2 my-auto ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        <span>Members</span>
                                    </div>
                                    <div class="my-auto mr-4">
                                        @if ($employees) {{count($employees[$group->id])}}
                                        @else 0 @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--SETTINGS DROPDOWN MENU -->
                        <div id="settings" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="p-2 text-sm text-gray-700" aria-labelledby="settingsButton">
                              <li class="hover:bg-gray-100 p-2 rounded-lg w-full">
                                <x-danger-button class="w-full">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                  </svg>                                              
                                </x-danger-button>
                              </li><hr class="my-1">
                              <li class="hover:bg-gray-100 p-2 rounded-lg w-full">
                                <x-danger-button class="w-full hover:bg-yellow-500 bg-yellow-400">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                  </svg>                                              
                                </x-danger-button>
                              </li><hr class="my-1">
                              <li class="hover:bg-gray-100 p-2 rounded-lg w-full">
                                Color de Fondo
                                <form action="#">
                                  @csrf
                                  <input type="color" class="p-1 bg-gray-200 rounded-md" value="#4F46E6">
                                </form>
                              </li><hr class="my-1">
                            </ul>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex justify-center bg-gray-100 p-6 rounded-lg">
                    <span class="mx-auto my-auto">
                        {{__('0 communities found!')}}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
