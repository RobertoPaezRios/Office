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
                Current Groups
            </h3>
            <a href="{{route('create-group')}}">
                <x-button class="bg-green-500 hover:bg-green-600 focus:bg-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="ml-2">
                        ADD NEW GROUP                  
                    </span>
                </x-button>
            </a>
        </div>
        <hr class="mt-4">
        <div class="w-full mt-4">
            @if (count($groups) > 0)
                <div class="flex flex-wrap gap-4">
                    @foreach ($groups as $group) 
                        <div class="w-72 h-72 rounded-lg shadow-xl border">
                            <div class="bg-indigo-600 rounded-t-lg h-20 p-3 text-white truncate">
                                <span class="font-bold text-lg">
                                    {{$group->name}}
                                </span><br>
                                <div class="text-md">
                                    <span class="my-auto">
                                        {{$owners[$group->id]->name}}
                                    </span>
                                </div>
                            </div>
                            <div class="w-20 h-20 p-3">
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex justify-center bg-gray-100 p-6 rounded-lg">
                    <span class="mx-auto my-auto">
                        {{__('0 franchises found! Create one now')}}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
