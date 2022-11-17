@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-header bg-primary text-white">มาใช้สิทธิแล้วทั้งหมด</div>
                <div class="card-body">
                    <h1 class="text-muted"> {{ $count_voted }} คน</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card">
                <div class="card-header bg-success text-white">สามาชิทั้งหมด</div>
                <div class="card-body">
                    <h1 class="text-muted"> {{ $count_user }} คน</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <form action="{{ url('admin/search/date') }}" method="post">
                @csrf
                @method('POST')
                <div class="d-flex justify-content-end">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="from" class="form-label">From</label>
                            <input type="date" name="from" class="form-control @error('from') is-invalid @enderror" value="{{ old('from') }}" id="">
                        </div>
                        <div class="col-md-5">
                            <label for="to" class="form-label">To</label>
                            <input type="date" name="to" class="form-control @error('to') is-invalid @enderror" value="{{ old('to') }}" id="">
                        </div>
                        <div class="col-md-2 mt-2">
                            <label for=""></label>
                            <input type="submit" value="Search" class="btn btn-outline-secondary">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">ผลคะแนนทั้งหมด</div>
                <div class="d-flex my-2 justify-content-center">
                    <form action="{{ url('admin/search') }}" method="post">
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
                                    <h5 class="text-{{ $user->voter->disabled == 1 ? 'danger' : 'primary' }} my-2">Code# {{ $user->voter->number }}</h5>
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
                                    <h5 class="text-{{ $voter->disabled == 1 ? 'danger' : 'primary' }} my-2">Code# {{ $voter->number }}</h5>
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
    </div>
</div>
@endsection