@extends('master')

@section('title', 'Page Title')

@section('content')
<div class="w-full max-w-x">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="#" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="hash" value={{$hash}}>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="assignables">
        Items to Assign (CSV)
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="assignables"
            name="assignables"
            type="text" 
            placeholder="Enter assignables here!"
            value="{{old('assignables') ? old('assignables') : $assignables}}">
    </div>
    <div class="mb-4">
      <ul>
        @foreach($errors->get('assignables') as $message)
          <li class="text-red-500 text-xs">{{$message}}</li>
        @endforeach
      </ul>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="assignees">
        Names to Assign (csv)
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="assignees"
            name="assignees" 
            type="text" 
            placeholder="Enter assignees here!"
            value="{{old('assignees') ? old('assignees') : $assignees}}">
    </div>
    <div class="mb-4">
      <ul>
        @foreach($errors->get('assignees') as $message)
          <li class="text-red-500 text-xs">{{$message}}</li>
        @endforeach
      </ul>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Submit
      </button>
    </div>
  </form>
</div>


@endsection