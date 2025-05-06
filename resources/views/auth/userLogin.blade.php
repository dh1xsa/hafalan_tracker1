<form action="{{ route('user-login') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>
@if($errors->has('login'))
    <div class="alert alert-danger">{{ $errors->first('login') }}</div>
@endif

