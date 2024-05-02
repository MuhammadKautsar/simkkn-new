<nav class="navbar bg-slate-900 navbar-expand-lg flex-wrap top-0 px-0 py-0">
    <div class="container py-2">
        <nav aria-label="breadcrumb">
            <div class="d-flex align-items-center">
                <span class="px-3 font-weight-bold text-lg text-white me-4">KKN Universitas Syiah Kuala</span>
            </div>
        </nav>
        <!-- <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item px-3 py-3 border-radius-sm  d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="nav-link text-white p-0">
                    Dashboard
                </a>
            </li>
        </ul> -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-md-auto  justify-content-end">
                <li class="nav-item dropdown ps-2 d-flex align-items-right">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/img/default-avatar.png" class="avatar avatar-sm" alt="avatar" />
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <!-- <li>
                                <a class="dropdown-item border-radius-md" href="{{ route('users.profile') }}">
                                    <div class="d-flex py-1">
                                        Profil
                                    </div>
                                </a>
                        </li> -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item border-radius-md" href="logout" onclick="event.preventDefault();
                            this.closest('form').submit();">
                                    <div class="d-flex py-1">
                                        Log out
                                    </div>
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- <hr class="horizontal w-100 my-0 dark"> -->
    <!-- <div class="container pb-3 pt-3">
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item border-radius-sm px-3 py-3 me-2  d-flex align-items-center">
                <a href="{{ route('profile') }}" class="nav-link text-white p-0">
                    Profile
                </a>
            </li>
            <li class="nav-item border-radius-sm px-3 py-3 me-2  d-flex align-items-center">
                <a href="" class="nav-link text-white p-0">
                    Sign In
                </a>
            </li>
            <li class="nav-item border-radius-sm px-3 py-3 me-2  d-flex align-items-center">
                <a href="" class="nav-link text-white p-0">
                    Sign Up
                </a>
            </li>
        </ul>
        <div class="ms-md-auto p-0 d-flex align-items-center w-sm-20">
            <div class="input-group border-dark">
                <span class="input-group-text border-dark bg-dark text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="opacity-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                <input type="text" class="form-control border-dark bg-dark" placeholder="Search"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
    </div> -->
</nav>
