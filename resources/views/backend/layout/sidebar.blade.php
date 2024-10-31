<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li>
                <a href="{{ route('adminDashboard') }}" aria-expanded="false"
                    class="{{ request()->routeIs('adminDashboard') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('subjectList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('subjectList', 'subjectCreateOrEdit') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Subjects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('subjectLessonsList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('subjectLessonsList', 'subjectLessonsCreateOrEdit') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Lessons</span>
                </a>
            </li>
            <li>
                <a href="{{ route('subjectTopicsList') }}" aria-expanded="false" aria-expanded="false"
                    class="{{ request()->routeIs('subjectTopicsList', 'subjectTopicsCreateOrEdit') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Subject Topics</span>
                </a>
            </li>

            
            <li>
                <a href="{{ route('yearsList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('yearsList', 'yearsCreateOrEdit') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Years</span>
                </a>
            </li>
            <li>
                <a href="{{ route('previousExamsList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('previousExamsList', 'previousExamsCreateOrEdit') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Previous Exam</span>
                </a>
            </li>
            <li>
                <a href="{{ route('questionList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('questionList', 'questionCreateOrEdit') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Questions</span>
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
