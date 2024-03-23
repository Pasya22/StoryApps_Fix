<div class="sidebar">
    <div class="brand" href="">
        <h3>LOGO</h3>
    </div>
    <div class="tablink {{ Route::currentRouteNamed('writter') ? 'active' : '' }}">
        <a class="" href="{{ route('writter') }}" id="defaultOpen"> Dashboard </a>
    </div>
    <div class="tablink {{ Route::currentRouteNamed('dataStories') ? 'active' : '' }}">
        <a class="" href="{{ route('dataStories') }}"> Stories </a>
    </div>
    <div class="tablink {{ Route::currentRouteNamed('dataChapters') ? 'active' : '' }}">
        <a class="" href="{{ route('dataChapters') }}"> Chapters </a>
    </div>
    <div class="tablink {{ Route::currentRouteNamed('dataCharacters') ? 'active' : '' }}">
        <a class="" href="{{ route('dataCharacters') }}"> Characters </a>
    </div>
    <div class="tablink {{ Route::currentRouteNamed('dataDialogs') ? 'active' : '' }}">
        <a class="" href="{{ route('dataDialogs') }}"> Dialogs </a>
    </div>
    <div class="tablink {{ Route::currentRouteNamed('dataFavorites') ? 'active' : '' }}">
        <a class="" href="{{ route('dataFavorites') }}"> Favorites </a>
    </div>
    <div class="tablink {{ Route::currentRouteNamed('dataRates') ? 'active' : '' }}">
        <a class="" href="{{ route('dataRates') }}"> Rates </a>
    </div>

</div>
