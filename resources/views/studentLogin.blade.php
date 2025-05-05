<form action="/student-login" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>
