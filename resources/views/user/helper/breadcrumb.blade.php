<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        {{-- user --}}
        @if(Auth::user()->role == 1)
        <li class="breadcrumb-item"><a href="{{ url('/users') }}">Home</a></li>
        @endif
        
        {{-- candidate --}}
        @if(Auth::user()->role == 2)
        <li class="breadcrumb-item"><a href="{{ url('/voters') }}">Home</a></li>
        @endif
        {{-- admin --}}
        @if(Auth::user()->role == 3)
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
        @endif
        
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>