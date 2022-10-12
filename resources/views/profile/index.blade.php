@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" id="mobile" value="{{ $user->mobile }}" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control-file">
                <div class="mt-2">
                    <img src="{{ Storage::url($user->avatar) }}" alt="avatar" width="100">
                </div>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection
