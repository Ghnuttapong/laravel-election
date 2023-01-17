<div class="col-md-4">
    <div class="d-flex shadow rounded-1  position-relative">
        {{-- candidate image --}}
        <div class="card-candidate-img">
            @if ($user->picture == null)
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
                <h5 class="fw-bold">{{ $user->name }}</h5>
                    <span class="{{ Auth::user()->id === $user->id? 'd-flex' : 'd-none' }} position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        คุณ
                    </span>
                    <h5
                        class="text-{{ $user->voter->disabled == 1 ? 'danger' : 'primary' }} ">
                        เบอร์ {{ $user->voter->number }}
                    </h5>
            </div>
            <div class="card-candidate-body">
                <div class="d-flex-between">
                    <p>คะแนนโหวต <span
                            class="text-success">{{ $user->voter->score }}</span>
                        คะแนน
                    </p>

                </div>
                <div class="text-muted">นโยบาย</div>
                <textarea name="" disabled id="" cols="30" class="form-control" rows="5">{{ $user->voter->policy }}</textarea>
            </div>
        </div>
    </div>
</div>