@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('clones.store') }}">
            @csrf
            <div class="form-group col-4">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="admin_username">Admin Username</label>
                <input type="text" name="admin_username" id="admin_username" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="admin_password">Admin Password</label>
                <input type="text" name="admin_password" id="admin_password" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="admin_url">Admin URL</label>
                <input type="text" name="admin_url" id="admin_url" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="domain">Domain</label>
                <input type="text" name="domain" id="domain" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Pending">Pending</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Suspended">Suspended</option>
                </select>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection
