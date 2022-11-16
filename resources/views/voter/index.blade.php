@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-2">
            <div class="card">
                <div class="card-header">ผลคะแนนทั้งหมด</div>
                <div class="d-flex my-2 justify-content-center">
                    <form action="{{ url('voters/search') }}" method="post">
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

