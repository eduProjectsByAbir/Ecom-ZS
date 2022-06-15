<img src="{{ asset(auth('web')->user()->profile_photo_url) }}" alt="" class="card-img-top" id="userImage">
<ul class="list-group list-group-flush">
    <a href="{{ route('user.home') }}" class="btn {{ Route::is('user.home') ? 'btn-success' : 'btn-info' }} btn-sm btn-block">Home</a>
    <a href="{{ route('user.myorders') }}" class="btn {{ Route::is('user.myorders') ? 'btn-success' : 'btn-info' }} btn-sm btn-block">Orders</a>
    <a href="{{ route('user.profile') }}" class="btn {{ Route::is('user.profile') ? 'btn-success' : 'btn-info' }} btn-sm btn-block">Profile Update</a>
    <a href="{{ route('user.profile.password') }}" class="btn {{ Route::is('user.profile.password') ? 'btn-success' : 'btn-info' }} btn-sm btn-block">Change Password</a>
    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
</ul>