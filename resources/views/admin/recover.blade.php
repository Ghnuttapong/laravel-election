@extends('layouts.app')

@section('content')
<div class="ms-3 pt-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/member') }}">Member</a></li>
                <li class="breadcrumb-item active" aria-current="page">Restore</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow border-0 animate__animated animate__fadeIn">
                    <div class="card-header bg-base1 d-flex justify-content-between">
                        <div class="fw-bold">
                            กู้คืนข้อมูล
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
                        <p> จำนวน {{ $count_users }} คน </p>
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
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if ($user->picture == null)
                                        <img src="{{ asset('profiles/default.png') }}" class="rounded-circle" height="50" width="50" alt="">
                                        @else
                                        <img src="{{ asset('profiles/' . $user->picture) }}" class="rounded-circle" height="50" width="50" alt="">
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
                                        <form action="{{ url('admin/recover/member') }}" method="post">
                                            @method('POST')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <input type="submit" value="กู้คืน" class="btn btn-info text-white">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
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