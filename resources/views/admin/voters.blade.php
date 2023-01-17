@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Candidate</li>
                </ol>
            </nav>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow border-0 animate__animated animate__fadeIn">
                        <div class="card-header border-0 bg-base1 fw-bold d-flex justify-content-between">
                            รายชื่อผู้ลงสมัคร
                        </div>

                        <div class="card-body">
                            @if (isset($msg))
                                <div class="alert alert-success">
                                    <strong>{{ $msg }}</strong>
                                </div>
                            @endif
                            @if (count($voters) < 1)
                                <div class="text-center">empty data.</div>
                            @else
                                <?php $i = 1; ?>
                                @foreach ($voters as $voter)
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5><?= $i++ ?>.</h5>
                                        <p>{{ $voter->user->name }}</p>
                                        <p>{{ $voter->user->email }}</p>
                                        <a href="{{ url('admin/voters/' . $voter->id) }}" class="btn btn-success">Approve</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
