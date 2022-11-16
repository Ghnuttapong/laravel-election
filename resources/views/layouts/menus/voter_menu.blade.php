@if ( Auth::user()->role == 2)
    <li class="nav-item">
        <a class="nav-link" href="{{ url('voters/score') }}">เช็คผลคะแนน</a>
    </li>
@endif