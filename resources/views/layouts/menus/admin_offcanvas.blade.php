<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-decoration-underline user-select-none" id="offcanvasMenuLabel">CMTC</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="offcanvas-menu">
            <li>
                <a class="sidebar-item {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('/admin') }}">
                    <i class="bi bi-house">หน้าแรก</i>
                </a>
            </li>
            <li>
                <a class="sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}"
                    href="{{ url('/admin/users') }}">
                    <i class="bi bi-people">จัดการสมาชิก</i>
                </a>
            </li>
            <li>
                <a class="sidebar-item {{ request()->is('admin/voters*') ? 'active' : '' }}"
                    href="{{ url('/admin/voters') }}">
                    <i class="bi bi-person-video2">รายชื่อผู้ลงสมัคร</i>
                </a>

            </li>
            <li>
                <a class="sidebar-item {{ request()->is('users/*/edit') ? 'active' : '' }}"
                    href="{{ route('users.edit', Auth::user()->id) }}">
                    <i class="bi bi-person-fill-gear">แก้ไขโปรไฟล์</i>
                </a>
            </li>
            <li>
                <a class="sidebar-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left">ออกจากระบบ</i>
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
