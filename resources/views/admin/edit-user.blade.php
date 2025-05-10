<form action="{{ route('admin-user-update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama</label>
    <input type="text" name="name" value="{{ $user->name }}">

    <button type="submit">Update</button>
</form>
@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif
@if(session('error'))
<p style="color:red;">{{ session('error') }}</p>
@endif