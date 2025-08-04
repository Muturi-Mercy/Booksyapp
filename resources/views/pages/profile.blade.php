@extends('layouts.user-app')

@section('content')
    <section class="profile-section">
        <div class="profile-content">
            <div class="pheader-title">
                <h2> Update Profile</h2>
            </div>

           

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <label class="plabel">Name:</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="pinput">

                <label class="plabel">Email:</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="pinput">

                <label class="plabel">Phone:</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="pinput">

                <label class="plabel">Address:</label>
                <textarea name="address" rows="3" class="pinput">{{ old('address', $user->address) }}</textarea>

                <button type="submit" class="pbtn">
                    Save Changes
                </button>
            </form>
        </div>
    </section>
@endsection
