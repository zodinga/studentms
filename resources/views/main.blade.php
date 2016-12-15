<!DOCTYPE html>
<html lang="en">
  @include('partials._head')
  <body>
    @include('partials._nav')
    <div class="container">
      @include('partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('partials._footer')
    </div>
    @include('partials._javascript')
    @yield('scripts')
  </body>
</html>