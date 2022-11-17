@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="">
                        รายชื่อผู้ลงสมัคร
                    </div>
                </div>

                <div class="card-body">
                    @if(isset($msg)) 
                        <div class="alert alert-success">
                            <strong>{{$msg}}</strong>
                        </div>
                    @endif
                    @if(count($voters) < 1)
                        <div class="text-center">empty data.</div>
                    @else
                        <?php $i = 1?>
                        @foreach($voters as $voter)
                        <div class="d-flex justify-content-between mb-2">
                            <h5><?= $i++ ?>.</h5> 
                            <p>{{ $voter->user->name }}</p>
                            <p>{{ $voter->user->email }}</p>
                            <a href="{{ url('admin/voters/'.$voter->id) }}" class="btn btn-primary">Approve</a>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

