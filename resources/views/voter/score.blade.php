@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ผลคะแนนของคุณ</div>

                <form action="{{ route('voters.update', $user->voter->id) }} " method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4> คุณ {{ $user->name }} </h4>
                        <p>คะแนนเสียงของคุณมี <strong class="text-success">{{ $user->voter->score }}</strong> คะแนน </p>
                        <textarea autocomplete="policy" name="policy" class="form-control @error('policy') is-invalid @enderror" cols="30" rows="10">{{ old('policy')? old('policy') : $user->voter->policy }}</textarea>
                        @error('policy')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection