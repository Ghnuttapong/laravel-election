@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ลงสมัคร Elector</div>
                <div class="card-body">
                    <form method="POST"  action="{{ route('users.store') }}">
                        @method('POST')
                        @csrf
                        <div class="row mb-3">
                            <label for="number" class="col-md-4 col-form-label text-md-end">Number</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}"  autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="policy" class="col-md-4 col-form-label text-md-end">Policy</label>

                            <div class="col-md-6">
                                <textarea name="policy" id="" autocomplete="policy" class="form-control @error('policy') is-invalid @enderror" cols="30" rows="10" >{{ old('policy') }}</textarea>
                                @error('policy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
