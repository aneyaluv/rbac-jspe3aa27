@extends('mainLayout')

@section('title', 'Manage Users')

@section('page-content')
<h1 class="text-center text-uppercase">Manage Users</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            @if(session('success'))
            <div class="alert alert-success" id="flash-message">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('admin.manageUsers') }}" method="POST">
                @csrf
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center text-white bg-success">User ID</th>
                            <th class="text-center text-white bg-success">Username</th>
                            <th class="text-center text-white bg-success">Email</th>
                            <th class="text-center text-white bg-success">Assigned Role</th>
                            <th class="text-center text-white bg-success">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td>
                                <select name="role_id[{{ $user->id }}]" class="form-select text-center">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button type="submit" name="user_id" value="{{ $user->id }}" class="btn btn-primary">Save</button>
                                    &nbsp;
                                    <form action="{{ route('admin.deleteUser', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <a href="{{ route('dash') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
</div>

@endsection