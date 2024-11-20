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
                <a href="{{ route('subjectSubTopicsList') }}" aria-expanded="false" aria-expanded="false"
                    class="{{ request()->routeIs('subjectSubTopicsList', 'subjectSubTopicsCreateOrEdit') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Subject Sub Topics</span>
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
                <a class="has-arrow" href="javascript:void()" aria-expanded="true">
                    <i class="icon icon-app-store"></i><span class="nav-text">Previous Exam</span></a>
                    <ul aria-expanded="true" class="mm-collapse mm-show">
                        <li><a href="{{ route('previousExamsCategoryList') }}">Previous Exam Category List</a></li>
                    <li>
                        <a href="{{ route('previousExamsList') }}">Previous Exam List</a>
                    </li>
                    <li><a href="{{ route('assignQuestionsList') }}">Assign Question List</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="true">
                    <i class="icon icon-app-store "></i><span class="nav-text">Custom Exam</span></a>
                <ul aria-expanded="true" class="mm-collapse mm-show">
                    <li>
                        <a  href="{{ route('customExamsList') }}">Custom Exam List</a>
                    </li>
                    
                </ul>
            </li>
            <li>
                <a href="{{ route('questionList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('questionList', 'questionCreate') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Questions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('GKList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('GKList') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">General Knowledge</span>
                </a>
            </li>
            <li>
                <a href="{{ route('teamMembersList') }}" aria-expanded="false"
                    class="{{ request()->routeIs('teamMembersList','teamMemberCreateorUpdate') ? 'active' : '' }}">
                    <i class="icon icon-app-store "></i>
                    <span class="nav-text">Team Members</span>
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
