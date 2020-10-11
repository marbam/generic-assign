<div class="mb-4 w-1/3 inline-block">
    <h4 class="mb-1">{{$heading}}s</h4>
    @for ($i = 0; $i < 10; $i++)
        @include('partials.assign-input', ['name' => $name])
    @endfor
    <button class="bg-blue-500 text-white rounded px-3 py-2 font-bold">Add New {{$heading}}</button>
</div>