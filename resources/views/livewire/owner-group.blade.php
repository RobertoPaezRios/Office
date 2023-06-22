<div>
    <div class="p-6 flex justify-relative gap-6">
        @foreach ($members as $member) 
            <div class="shadow-md h-96 w-1/4 bg-gray-100 sm:rounded-lg place-items-center grid">
            <div class="p-6">  
                <img class="rounded-full w-full h-full border-2 border-gray-500" src="{{$member->profile_photo_url}}" alt=""></div>
            <div class="text-center">
                <h3 class="text-gray-900 text-xl font-bold">{{$member['name']}}</h3>
                <h4 class="text-gray-500 text-sm">{{$member['email']}}</h4>
            </div>
            </div>
        @endforeach
    </div>
</div>
