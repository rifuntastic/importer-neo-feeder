<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @stack('page-stylesheet')
</head>

<body>
    <div class="container-scroller">
        @yield('content')
    </div>

    @include('layouts.script')
    @stack('page-script')
</body>

</html>
