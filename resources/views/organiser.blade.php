@extends('master')

@section('title', 'Page Title')

@section('content')
<div class="w-full max-w-x">
    <h1>Results</h1>
    <table>
        <thead>
            <th>Assignable</th>
            <th>Assigned to</th>
        </thead>
        <body>
            @foreach($results as $assignee => $assignable)
                <tr>
                    <td>{{$assignable}}</td>
                    <td>{{$assignee}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
      <a href="/entry/{{$hash}}" 
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Repeat
      </a>
</div>


@endsection