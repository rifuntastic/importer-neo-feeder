<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @stack('page-stylesheet')
</head>

<body>
    <div class="container-scroller">
        @include('layouts.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @if ($mode['mode'] == 'sandbox')
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="text-center font-weight-bold m-0">MODE SANDBOX</h4>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($mode['mode'] == 'live')
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="text-center font-weight-bold m-0">MODE LIVE</h4>
                                <p class="text-center font-weight-bold m-0">Untuk uji coba, silakan
                                    menggunakan mode sandbox. Anda dapat berganti mode pada menu <a
                                        href="{{ url('dashboard/sandbox') }}">Pengaturan >
                                        Sandbox</a></p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @yield('content')
                </div>
                {{-- @include('layouts.footer') --}}
            </div>
        </div>
    </div>

    @include('layouts.script')
    @stack('page-script')
</body>

</html>
