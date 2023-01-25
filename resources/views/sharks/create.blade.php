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
        <a class="navbar-brand" href="{{ URL::to('sharks') }}">shark Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('sharks') }}">View All sharks</a></li>
        <li><a href="{{ URL::to('sharks/create') }}">Create a shark</a>
    </ul>
</nav>

<h1>Create a shark</h1>

<!-- if there are creation errors, they will show here -->


{{-- <form action="{{(route('sharks.store'))}}" method='post'> --}}
<form action="{{url('sharks')}}" method='post'>
    {{ csrf_field() }}
    <label for="name" name:></label><br>
    <input type="text" id="name" name="name"><br>
    <label for="email">email</label><br>
    <input type="email" id="email" name="email"><br><br>
    <label for="email">shark_level</label><br>
    <input type="text" id="shark_level" name="shark_level"><br><br>
    <input type="submit" value="Submit">
</form>

</div>
</body>
</html>
