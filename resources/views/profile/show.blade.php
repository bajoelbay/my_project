
<img src="{{ $user->profile_picture ? Storage::disk('s3')->url($user->profile_picture) : asset('default-avatar.png') }}" alt="Profile Picture" width="150" />

<a href="{{ route('profile.edit') }}">Edit Profile</a>
