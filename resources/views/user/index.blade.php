@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>
            <div class="row justify-content-center">
                @if (!empty($score))
                    <div class="col-md-10">
                        <div class="card border-0 shadow animate__animated animate__fadeIn">
                            <div class="card-header  bg-white  border-0 fw-bold">การโหวดของคุณ</div>

                            <div class="card-body">
                                <hr>
                                <div class="px-5 d-flex justify-content-between align-items-center">
                                    <h5>{{ $score->user->name }} </h5>
                                    <h5 class="text-primary my-2">หมายเลขที่ {{ $score->number }}</h5>
                                    <h5 class="d-flex my-2 aling-items-end ">
                                        มีคะแนนโหวต<p class="text-success mx-2">{{ $score->score }}</p><span>คะแนน</span>
                                    </h5>
                                </div>
                                <hr>
                                <small class="ps-1 text-muted">นโยบายคือ</small>
                                <textarea class="form-control border-0 rounded-0" rows="5" style="resize: none;" disabled>{{ $score->policy }}</textarea>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$count_voted)
                    <div class="col-md-10 mt-2">
                        <div class="card animate__animated animate__fadeIn">
                            <div class="card-header fw-bold bg-base1">ลงคะแนนเสียงของคุณ</div>
                            <div class="d-flex my-2 justify-content-center">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input placeholder="search..." type="search" value="" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" value="Search" class="btn btn-outline-secondary">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row p-4">
                                    {{-- users have not vote yet --}}
                                    @foreach ($voters as $val)
                                        <div class="col-md-4">
                                            <div class="d-flex shadow rounded-1 position-relative">
                                                {{-- candidate image --}}
                                                <div class="card-candidate-img">
                                                    @if ($val->user->picture == null)
                                                        <img src="{{ asset('profiles/default.png') }}" width="100%"
                                                            height="100%" alt="">
                                                    @else
                                                        <img src="{{ asset('profiles/' . $val->user->picture) }}"
                                                            width="100%" height="100%" alt="">
                                                    @endif
                                                </div>
                                                {{-- end candidate image --}}
                                                <div class="p-3 ">
                                                    <div class="d-flex-between">
                                                        <p class="fw-bold">{{ $val->user->name }}</p>
                                                            <span
                                                                class="{{ Auth::user()->id === $val->user->id ? 'd-flex' : 'd-none' }} position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                คุณ
                                                            </span>
                                                            <p
                                                                class="text-{{ $val->disabled == 1 ? 'danger' : 'primary' }} ">
                                                                เบอร์ {{ $val->number }}
                                                            </p>
                                                    </div>
                                                    <div class="card-candidate-body">
                                                        <div class="d-flex-between">
                                                            <p>คะแนนเสียง <span
                                                                    class="text-success">{{ $val->score }}</span>
                                                                คะแนน
                                                            </p>

                                                        </div>
                                                        <div class="text-muted">นโยบาย</div>
                                                        <textarea name="" disabled id="" cols="30" class="form-control" rows="5">{{ $val->policy }}</textarea>
                                                        <form action="{{ route('score.update', $val->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="mt-2 w-100 rounded-pill btn btn-base1 border-0">
                                                                <i class="bi bi-check-lg"></i> เลือก
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>       
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-10 mt-2">
                        <div class="card shadow animate__animated animate__fadeIn">
                            <div class="card-header bg-base1 fw-bold">ผลคะแนนทั้งหมด</div>
                            <div class="d-flex my-2 justify-content-center">
                                <form action="{{ url('users/search') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input placeholder="search..." type="search" name="search"
                                                value="{{ old('search') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" value="Search" class="btn btn-outline-secondary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if (isset($users))
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($users as $user)
                                            @include('utility.card_user')
                                        @endforeach
                                    </div>
                                    {{ $users->links() }}
                                </div>
                            @else
                                <!-- show default -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($voters as $voter)
                                            @include('utility.card_voter')
                                        @endforeach
                                    </div>
                                    {{ $voters->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
