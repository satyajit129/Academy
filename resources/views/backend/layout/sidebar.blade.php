<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li>
                <a href="{{ route('adminDashboard') }}" aria-expanded="false" class="{{ request()->routeIs('adminDashboard') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('subjectList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('subjectList') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Subjects</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('settings') }}" aria-expanded="false"
                    class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>