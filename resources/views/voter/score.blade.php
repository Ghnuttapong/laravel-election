@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        <div class="container">
            @include('user.helper.breadcrumb')
            <div class="row justify-content-center animate__animated animate__fadeIn ">
                <div class="col-md-8">
                    <div class="card border-0 shadow">
                        <div class="card-header border-0 fw-bold">ผลคะแนนของคุณ</div>

                        <div class="text-center my-2">
                            @if ($user->picture == null)
                                <img src="{{ asset('profiles/default.png') }}" class="rounded-circle" height="100"
                                    width="100" alt="">
                            @else
                                <img src="{{ asset('profiles/' . $user->picture) }}" class="rounded-circle" height="100"
                                    width="100" alt="">
                            @endif
                        </div>
                        <form action="{{ route('voters.update', $user->voter->id) }} " method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="text-center">
                                    <h4> คุณ {{ $user->name }} </h4>
                                    <p>คะแนนเสียงของคุณมี <strong class="text-success">{{ $user->voter->score }}</strong>
                                        คะแนน </p>
                                </div>
                                <textarea autocomplete="policy" name="policy" class="form-control @error('policy') is-invalid @enderror" cols="30"
                                    rows="10">{{ old('policy') ? old('policy') : $user->voter->policy }}</textarea>
                                <small class="text-muted ps-2">แก้ไข นโยบายของคุณ</small>
                                @error('policy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary w-50 mt-2">ยืนยัน</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
