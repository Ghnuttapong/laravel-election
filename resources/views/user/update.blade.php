@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        <div class="container">
            @include('user.helper.breadcrumb')

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow animate__animated animate__fadeIn">
                        <div class="card-header bg-base1 border-0 fw-bold">อัพเดทโปรไฟล์</div>

                        @if ($message = Session::get('msg'))
                            <div class="container px-5 mt-2">
                                <div class="alert alert-success alert-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="my-4 p-2 text-center">
                                @if ($user->picture == null)
                                    <img src="{{ asset('profiles/default.png') }}" class="rounded-circle" height="100"
                                        width="100" alt="">
                                @else
                                    <img src="{{ asset('profiles/' . $user->picture) }}" class="rounded-circle" height="100"
                                        width="100" alt="">
                                @endif
                            </div>
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('users.update', Auth::user()->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">ชื่อ</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ $user->name }}" autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">อีเมล์</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            disabled value="{{ $user->email }}" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">รหัสผ่าน</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="picture" class="col-md-4 col-form-label text-md-end">รูปภาพ</label>

                                    <div class="col-md-6">
                                        <input type="file" name="picture"
                                            class="form-control @error('picture') is-invalid @enderror" id="">

                                        @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn w-100 btn-base1">ยืนยัน</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
