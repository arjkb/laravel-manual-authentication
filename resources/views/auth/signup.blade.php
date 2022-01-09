@extends('base')

@section('content')
<form class="mt-5" method="POST" action="signup">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <!-- skipping the password confirmation field in this dummy example -->

    <button type="submit" class="btn btn-primary">Signup</button>
</form>
@endsection