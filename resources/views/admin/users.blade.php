@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Member</li>
                </ol>
            </nav>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow border-0 animate__animated animate__fadeIn">
                        <div class="card-header bg-base1 d-flex justify-content-between">
                            <div class="fw-bold">
                                จัดการสมาชิกผู้ใช้
                            </div>
                            <div class="">
                                <a class="text-decoration-none badge bg-success" href="{{ route('admin.show', 1) }}">
                                    <span>User</span>
                                </a>
                                <a class="text-decoration-none badge bg-primary" href="{{ route('admin.show', 2) }}">
                                    <span>Voter</span>
                                </a>
                                <a class="text-decoration-none badge bg-warning" href="{{ route('admin.show', 3) }}">
                                    <span>Admin</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <form action="{{ url('admin/search/member') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="search" placeholder="search..." name="search" id=""
                                                class="form-control w-100">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="submit" value="Search" class="btn btn-outline-secondary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @if (isset($role))
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    @if ($user->picture == null)
                                                        <img src="{{ asset('profiles/default.png') }}"
                                                            class="rounded-circle" height="50" width="50"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('profiles/' . $user->picture) }}"
                                                            class="rounded-circle" height="50" width="50"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->role == 1)
                                                        <span class="badge bg-success">User</span>
                                                    @endif
                                                    @if ($user->role == 2)
                                                        <span class="badge bg-primary">Voter</span>
                                                    @endif
                                                    @if ($user->role == 3)
                                                        <span class="badge bg-warning">Admin</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.destroy', $user->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="{{ route('users.show', $user->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <input type="submit" value="Del" class="btn btn-danger">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    @if ($user->picture == null)
                                                        <img src="{{ asset('profiles/default.png') }}"
                                                            class="rounded-circle" height="50" width="50"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('profiles/' . $user->picture) }}"
                                                            class="rounded-circle" height="50" width="50"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->role == 1)
                                                        <span class="badge bg-success">User</span>
                                                    @endif
                                                    @if ($user->role == 2)
                                                        <span class="badge bg-primary">Voter</span>
                                                    @endif
                                                    @if ($user->role == 3)
                                                        <span class="badge bg-warning">Admin</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.destroy', $user->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="{{ route('users.show', $user->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <input type="submit" value="Del" class="btn btn-danger">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
