@extends('layouts.app')

@section('content')
    <div class="ms-3 pt-3">
        <div class="container">
            {{-- breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>
            {{-- report index --}}
            @include('admin.report.index_report')
            {{-- main --}}
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card border-0 shadow animate__animated animate__fadeIn">
                        <div class="card-header border-0 bg-base1">ผลคะแนนทั้งหมด</div>
                        <div class="d-flex justify-content-between py-3 px-5 gap-5">
                            @include('admin.form.search')
                        </div>
                        {{-- description note --}}
                        <div class="note-container">
                            <div class="note-unapprove">ยังไม่อนุมัติ</div>
                            <div class="note-approve">อนุมัติแล้ว</div>
                        </div>
                        @if (isset($users))
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($users as $user)
                                        <div class="col-md-4">
                                            <div class="d-flex shadow rounded-1 overflow-hidden">
                                                {{-- candidate image --}}
                                                <div class="card-candidate-img">
                                                    @if ( $user->picture == null)
                                                        <img src="{{ asset('profiles/default.png') }}" width="100%"
                                                            height="100%" alt="">
                                                    @else
                                                        <img src="{{ asset('profiles/' . $user->picture) }}"
                                                            width="100%" height="100%" alt="">
                                                    @endif
                                                </div>
                                                {{-- end candidate image --}}
                                                <div class="p-3">
                                                    <div class="d-flex-between">
                                                        <h5 class="fw-bold">{{ $user->name }}</h3>
                                                        <h5
                                                            class="text-{{ $user->voter->disabled == 1 ? 'danger' : 'primary' }} ">
                                                            เบอร์ {{ $user->voter->number }}
                                                        </h5>
                                                    </div>
                                                    <div class="card-candidate-body">
                                                        <div class="d-flex-between">
                                                            <p>คะแนนโหวต <span class="text-success">{{ $user->voter->score }}</span>
                                                                คะแนน
                                                            </p>

                                                        </div>
                                                        <div class="text-muted">นโยบาย</div>
                                                        <textarea name="" disabled id="" cols="30" class="form-control" rows="5">{{ $user->voter->policy }}</textarea>
                                                    </div>
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
                                    @foreach ($voters as $voter)
                                        <div class="col-md-4">
                                            <div class="d-flex shadow rounded-1 overflow-hidden">
                                                {{-- candidate image --}}
                                                <div class="card-candidate-img">
                                                    @if ($voter->user->picture == null)
                                                        <img src="{{ asset('profiles/default.png') }}" width="100%"
                                                            height="100%" alt="">
                                                    @else
                                                        <img src="{{ asset('profiles/' . $voter->user->picture) }}"
                                                            width="100%" height="100%" alt="">
                                                    @endif
                                                </div>
                                                {{-- end candidate image --}}
                                                <div class="p-3">
                                                    <div class="d-flex-between">
                                                        <h5 class="fw-bold">{{ $voter->user->name }}</h3>
                                                        <h5
                                                            class="text-{{ $voter->disabled == 1 ? 'danger' : 'primary' }} ">
                                                            เบอร์ {{ $voter->number }}
                                                        </h5>
                                                    </div>
                                                    <div class="card-candidate-body">
                                                        <div class="d-flex-between">
                                                            <p>คะแนนโหวต <span class="text-success">{{ $voter->score }}</span>
                                                                คะแนน
                                                            </p>

                                                        </div>
                                                        <div class="text-muted">นโยบาย</div>
                                                        <textarea name="" disabled id="" cols="30" class="form-control" rows="5">{{ $voter->policy }}</textarea>
                                                    </div>
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

    </div>
@endsection
