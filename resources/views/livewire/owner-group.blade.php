<div>
    <div class="py-14 px-14 flex flex-wrap justify-items-center content-center justify-relative gap-6">
        @foreach ($members as $key => $member) 
            <div class="shadow-md h-96 w-64 bg-gray-100 sm:rounded-lg place-items-center grid">
                <div class="relative">  
                    <img class="rounded-full object-cover w-40 h-40 shadow-xl" src="{{$member->profile_photo_url}}" alt="">
                    @if ($key < 1)
                        <span class="top-0 absolute w-10 h-10 bg-yellow-400 border-2 border-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-6 h-6 mx-auto mt-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
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
</div>
