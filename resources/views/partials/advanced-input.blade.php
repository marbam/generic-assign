<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{$variable}}">
        {{$heading}} to Assign (CSV)
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="{{$variable}}"
            type="text" 
            placeholder="Enter {{$variable}} here!"
            value="{{old($variable) ? old($variable) : $blade_var}}">
    </div>
    <div class="mb-4">
    <ul>
        @foreach($errors->get($variable) as $message)
            <li class="text-red-500 text-xs">{{$message}}</li>
        @endforeach
    </ul>
</div>