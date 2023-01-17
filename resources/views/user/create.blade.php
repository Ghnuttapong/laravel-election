@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        
        <div class="container">
            @include('user.helper.breadcrumb')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow border-0 animate__animated animate__fadeIn">
                        <div class="card-header border-0 fw-bold text-center">ลงสมัคร Candidate</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.store') }}">
                                @method('POST')
                                @csrf
                                <span class="text-muted">นโยบายของคุณคือ</span>
                                <textarea name="policy" id="" autocomplete="policy" class="form-control @error('policy') is-invalid @enderror"
                                    cols="30" rows="10">{{ old('policy') }}</textarea>
                                @error('policy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror





                                <div class="text-center my-3 ">
                                    <button type="submit" class="shadow btn w-50 btn-base1">ยืนยันการลงสมัคร</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
