<form action="{{ url('admin/search/date') }}" method="post">
    @csrf
    @method('POST')
    <div class="">
        <div class="row">
            <div class="col-md-5">
                <input type="date" name="from"
                    class="form-control @error('from') is-invalid @enderror"
                    value="{{ old('from') }}" id="">
            </div>
            <div class="col-md-5">
                <input type="date" name="to"
                    class="form-control @error('to') is-invalid @enderror"
                    value="{{ old('to') }}" id="">
            </div>
            <div class="col-md-2">
                <input type="submit" value="Search" class="btn btn-outline-secondary">
            </div>
        </div>
    </div>
</form>

<form action="{{ url('admin/search') }}" method="post">
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