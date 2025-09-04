<style>
    
    @media screen and (max-width: 430px) {
        .profile-update{
            width: 100% !important;
        }
    }
    </style>


<section>
    <h2 class="text-lg font-medium text-gray-900 white-color">Profile Information</h2>
    <p class="mt-1 text-sm text-gray-600 white-color">Update your account's profile information.</p>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 w-50 profile-update">
        @csrf
        @method('patch')

        <div class="row">
        <div class="col-md-4 mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}">
            <x-input-error :messages="$errors->get('name')" class="text-danger small" />
        </div>

        <div class="col-md-4 mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}">
            <x-input-error :messages="$errors->get('email')" class="text-danger small" />
        </div>

        <div class="col-md-4 mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}">
            <x-input-error :messages="$errors->get('phone')" class="text-danger small" />
        </div>

        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</section>

