<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <!-- Profile Picture -->
    <div class="mt-4">
        <label for="profile_picture">Profile Picture</label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" />
    </div>

    <!-- Other profile fields -->

    <div class="mt-4">
        <button type="submit">Save</button>
    </div>
</form>
