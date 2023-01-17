<div class="sidebar-container d-md-flex d-none">
    <div class="d-flex sidebar gap-2 align-items-center w-100">
        <h4 class="fw-bold user-select-none text-base1">
            GT
        </h4>

        <a class="sidebar-item {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('/admin') }}">
            <i class="bi bi-house"></i>
        </a>
        <a class="sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}"
            href="{{ url('/admin/users') }}">
            <i class="bi bi-people"></i>
        </a>
        <a class="sidebar-item {{ request()->is('admin/voters*') ? 'active' : '' }}"
            href="{{ url('/admin/voters') }}">
            <i class="bi bi-person-video2"></i>
        </a>
        <a class="sidebar-item {{ request()->is('users/*/edit') ? 'active' : '' }}"
            href="{{ route('users.edit', Auth::user()->id) }}">
            <i class="bi bi-person-fill-gear"></i>
        </a>

        <a class="sidebar-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-left"></i>
        </a>
        

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>