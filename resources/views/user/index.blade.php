@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(!empty($score))
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">การโหวดของคุณ</div>

                <div class="card-body">
                    <strong> คุณ {{ $score->user->name }} </strong>
                    <h5 class="text-primary my-2">Code# {{ $score->number }}</h5>
                    <h4 class="d-flex my-2 aling-items-end ">
                        มีคะแนนโหวต<p class="text-success mx-2">{{ $score->score }}</p><span>คะแนน</span>
                    </h4>
                    <hr>
                    <h5>Policy</h5>
                    <textarea class="form-control" rows="5" style="resize: none;" disabled>{{ $score->policy }}</textarea>
                </div>
            </div>
        </div>
        @endif
        @if(!$count_voted)
        <div class="col-md-10 mt-2">
            <div class="card">
                <div class="card-header">Vote คะแนน</div>
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
                        @foreach($voters as $val)
                        <div class="col-md-3">
                            <!-- ---------------- form --------------------- -->
                            <form action="{{ route('score.update', $val->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="card-body">
                                        คุณ <strong> {{ $val->user->name }} </strong>
                                        <div class="text-center mt-2">
                                            @if($val->user->picture == null)
                                            <img src="{{ asset('profiles/default.png') }}" class="rounded-circle" height="50" width="50" alt="">
                                            @else
                                            <img src="{{ asset('profiles/'.$val->user->picture) }}" class="rounded-circle" height="50" width="50" alt="">
                                            @endif
                                        </div>
                                        <p>Policy</p>
                                        <textarea class="form-control" rows="5" style="resize: none;" disabled>{{ $val->policy }}</textarea>
                                        <input type="submit" class="mt-2 float-end btn btn-success" value="Vote">
                                    </div>
                                </div>
                            </form>
                            <!-- ---------------- form --------------------- -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-10 mt-2">
            <div class="card">
                <div class="card-header">ผลคะแนนทั้งหมด</div>
                <div class="d-flex my-2 justify-content-center">
                    <form action="{{ url('users/search') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-10">
                                <input placeholder="search..." type="search" name="search" value="{{ old('search') }}" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" value="Search" class="btn btn-outline-secondary">
                            </div>
                        </div>
                    </form>
                </div>
                @if(isset($users))
                <div class="card-body">
                    <div class="row">
                        @foreach($users as $user)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">{{ $user->name }}</div>
                                <div class="card-body">
                                    <h5> คะแนนโหวต <span class="text-success">{{ $user->voter->score }}</span> คะแนน </h5>
                                    <h5 class="text-primary my-2">Code# {{ $user->voter->number }}</h5>
                                    <div class="text-center">
                                        @if($user->picture == null)
                                        <img src="{{ asset('profiles/default.png') }}" class="rounded-circle" height="50" width="50" alt="">
                                        @else
                                        <img src="{{ asset('profiles/'.$user->picture) }}" class="rounded-circle" height="50" width="50" alt="">
                                        @endif
                                    </div>
                                    <div class="text-muted">Policy</div>
                                    <textarea name="" disabled id="" cols="30" class="form-control" rows="5">{{ $user->voter->policy }}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $users->links() }}
                </div>
                @else
                <!-- show default -->
                <div class="card-body">
                    <div class="row">
                        @foreach($voters as $voter)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">{{ $voter->user->name }}</div>
                                <div class="card-body">
                                    <h5> คะแนนโหวต <span class="text-success">{{ $voter->score }}</span> คะแนน </h5>
                                    <h5 class="text-primary my-2">Code# {{ $voter->number }}</h5>
                                    <div class="text-center">
                                        @if($voter->user->picture == null)
                                        <img src="{{ asset('profiles/default.png') }}" class="rounded-circle" height="50" width="50" alt="">
                                        @else
                                        <img src="{{ asset('profiles/'.$voter->user->picture) }}" class="rounded-circle" height="50" width="50" alt="">
                                        @endif
                                    </div>
                                    <div class="text-muted">Policy</div>
                                    <textarea name="" disabled id="" cols="30" class="form-control" rows="5">{{ $voter->policy }}</textarea>
                                </div>
                            </div>
                        </div>
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