<div>
    <div class="bg-gray-200 aspect-video
                            border border-indigo-500
                            flex justify-center items-center
                            text-indigo-500 text-6xl font-extrabold text-opacity-50 mb-4 ">
        @if($videoHidden)
            <iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                    allowfullscreen="true"
                    src="{{$url}}"
                    class="w-full aspect-video"
                    style="border:none;overflow:hidden"></iframe>
        @endif
    </div>
</div>
