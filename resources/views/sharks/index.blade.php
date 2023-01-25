<!DOCTYPE html>
<html>
<head>
    <title>Shark App</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        {{-- <a class="navbar-brand" href="{{ URL('sharks') }}">shark Alert</a> --}}
        <a class="navbar-brand" href="sharks">shark Alert</a>
        {{-- <a class="navbar-brand" href="{{route('sharks.index')}}">shark Alert</a> --}}
    </div>
    <ul class="nav navbar-nav">
        {{-- <li><a href="{{route('sharks.index')}}">View All sharks</a></li> --}}
        <li><a href="sharks">View All sharks</a></li>


        {{-- <li><a href="{{ URL('sharks/create') }}">Create a shark</a> --}}
            <li><a href="sharks/create" >Create a shark</a></li>
            {{-- <li><a href="{{ route('sharks.create') }}">Create a shark</a> --}}
    </ul>
</nav>

<h1>All the sharks</h1>

<!-- will be used to show any messages -->
@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>shark Level</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($sharks as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->shark_level }}</td>

            <td>

                <a class="btn btn-small btn-success" href="{{ URL::to('sharks/' . $value->id) }}">Show this shark</a>
                {{-- <a class="btn btn-small btn-success" href="{{route('sharks.show',$value->id)}}">Show this shark</a> --}}


                <!-- edit this shark (uses the edit method found at GET /sharks/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('sharks/' . $value->id . '/edit') }}">Edit this shark</a>
                {{-- <a class="btn btn-small btn-info" href="{{ route('sharks.edit',$value->id) }}">Edit this shark</a> --}}



                <!-- delete this shark (uses the delete method found at GET /sharks/{id}/delete -->
                {{-- <a class="btn btn-small btn-danger" href="{{ URL::to('sharks/' . $value->id . '/delete') }}">Delete this shark</a> --}}
                {{-- <a class="btn btn-small btn-info" href="{{ route('sharks.delete',$value->id) }}">Delete this shark</a> --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>
