<div>
    <div class="bg-{{ $color }}-200 aspect-video
                            border border-indigo-500
                            flex justify-center items-center
                            text-indigo-500 text-6xl font-extrabold text-opacity-50 mb-4 ">
        <iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                allowfullscreen="true"
                src="{{$url}}"
                class="w-full aspect-video {{ $videoHidden ? 'hidden' : ''}}"
                style="border:none;overflow:hidden"></iframe>
{{--        {{ $videoHidden ? ($streamKey ?? 'FB') : '' }}--}}
    </div>
    {{ $status ?? '' }}
</div>
