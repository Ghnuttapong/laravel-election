@extends('layouts.app')

@section('content')
<img src="{{ asset('assets/img/bg-img1.jpg') }}" style="position: absolute; object-fit: cover; filter:blur(10px)" width="100%" height="100%" alt="">
<div class="row center">
    <div class="col-md-4 animate__animated animate__fadeIn">
        <div class="card my-2">
            <div class="card-body text-center">
                <h4 class="text-muted">ระบบลงทะเบียนเลือกตั้ง</h3>
            </div>
        </div>
        <div class="card shadow border-0" style="background: #ccc; opacity: 0.8;">
            <div class="card-header fw-bold border-0 text-center bg-base1">{{ __('Login') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">อีเมล์</label>

                        <div class="col-md-6">
                            <input id="email" type="email" placeholder="example@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">รหัสผ่าน</label>

                        <div class="col-md-6">
                            <input id="password" placeholder="****" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    จำฉันไว้ในระบบ
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 offset-md-4">
                            <a href="{{ route('register') }}">คุณยังไม่มีบัญชีใช่หรือไม่?</a>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="btn w-100 bordered-none btn-primary">
                                เข้าสู่ระบบ
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection