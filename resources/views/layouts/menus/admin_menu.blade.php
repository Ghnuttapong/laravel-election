    @if ( Auth::user()->role == 3)
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ url('/admin/users') }}">จัดการสมาชิกผู้ใช้</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/voters*') ? 'active' : '' }}" href="{{ url('/admin/voters') }}">ผู้ลงสมัคร Candidate</a>
        </li>
    @endif