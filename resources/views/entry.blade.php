@extends('master')

@section('title', 'Page Title')

@section('styles')
  <style>
  /* CHECKBOX TOGGLE SWITCH */
  /* @apply rules for documentation, these do not work as inline style */
  .toggle-checkbox:checked {
    @apply: right-0 border-green-400;
    right: 0;
    border-color: #68D391;
  }
  .toggle-checkbox:checked + .toggle-label {
    @apply: bg-green-400;
    background-color: #68D391;
  }
  </style>
@endsection

@section('content')
<div class="w-full max-w-x px-8 pt-6 bg-gray-400">
  <h1 class="text-4xl">Random Allocator</h1>
  <p>Give us a list of names, and a list of things to allocate, and we'll do the job for you!</p>
  <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
      <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
      <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
  </div>
  <label for="toggle" class="text-xs text-gray-700">Advanced Mode</label>
</div>

<div class="w-full max-w-x">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="#" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="hash" value={{$hash}}>
    <div id="advanced">
      @include('partials.advanced-input', ['heading' => 'Items', 'variable' => 'assignables', 'blade_var' => $assignables])
      @include('partials.advanced-input', ['heading' => 'Names', 'variable' => 'assignees', 'blade_var' => $assignees])
    </div>
    <div id="simple">
      @include('partials.assign-block', ['heading' => 'Assignable', 'name' => 'assignables-ind'])
      @include('partials.assign-block', ['heading' => 'Assignee', 'name' => 'assignees-ind'])
    </div>

    <div class="flex items-center justify-between">
      <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Submit
      </button>
    </div>
  </form>
</div>


@endsection