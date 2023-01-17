@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>
            <div class="row justify-content-center animate__animated animate__fadeIn">
                <div class="col-md-10 mt-2">
                    <div class="card border-0 shadow">
                        <div class="card-header border-0 fw-bold">ผลคะแนนทั้งหมด</div>
                        <div class="d-flex my-2 justify-content-center">
                            <form action="{{ url('voters/search') }}" method="post">
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
            </div>
        </div>
    </div>
@endsection
