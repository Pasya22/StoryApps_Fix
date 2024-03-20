<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">StoryApps<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class=" nav-item {{ Route::currentRouteNamed('Dashboard') ? 'active' : '' }}">

        <a class="nav-link" href="{{ route('Dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            Dashboard </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <li class="nav-item {{ Route::currentRouteNamed('DataUser') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/user/DataUser">
            <i class="fas fa-user"></i>
            Data User
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataRequestWriter') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/DataRequestWriter">
            <i class="fas fa-user"></i>
            Data Request
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataStory') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/story/story/DataStory">
            <i class="fas fa-book"></i>
            Data Stories
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataCategories') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/Categories/DataCategories">
            <i class="fas fa-list-alt"></i>
            Data Categories
        </a>

    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Company
    </div>

    <li class="nav-item {{ Route::currentRouteNamed('DataCompany') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/company/DataCompany">
            <i class="fas fa-building"></i>
            Company
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataContact') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/contact/DataContact">
            <i class="fas fa-phone"></i>
            Contact
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataFaqs') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/faqs/DataFaqs">
            <i class="fas fa-info"></i>
            Faqs
        </a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Compnent Stories
    </div>
    <li class="nav-item {{ Route::currentRouteNamed('DataGenre') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/story/genre/DataGenre">
            <i class="fas fa-list"></i>
            Data Genre
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataChapters') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/story/chapters/DataChapters">
            <i class="fas fa-camera"></i>
            Data Chapters
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataCharacters') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/story/characters/DataCharacters">
            <i class="fas fa-user-friends"></i>
            Data Characters
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataDialog') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/story/dialog/DataDialog">
            <i class="fas fa-quote-left"></i>
            Data Dialog
        </a>

    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Value Story
    </div>
    <li class="nav-item {{ Route::currentRouteNamed('DataRate') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="/admin/story/rate/DataRate">
            <i class="fas fa-star"></i>
            Data Rate
        </a>

    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataComment') ? 'active' : '' }} ">

        <a class="nav-link collapsed" href="/admin/story/comment/DataComment">
            <i class="fas fa-comment"></i>
            Data Comment
        </a>
    </li>
    <li class="nav-item {{ Route::currentRouteNamed('DataFavorite') ? 'active' : '' }} ">

        <a class="nav-link collapsed" href="/admin/story/favorite/DataFavorite">
            <i class="fas fa-heart"></i>
            Data Favorite
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
