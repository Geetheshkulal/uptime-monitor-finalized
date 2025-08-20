<!DOCTYPE html>
<html lang="en">

@include('body.header')

<body id="page-top" class="loading" >
    <div id="wrapper">
        @include('body.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('body.topbar')

                <!-- Page Content -->
                @yield('content')

            </div>
            {{-- @if (!request()->routeIs('premium.page')) --}}
            @include('body.footer')
            {{-- @endif --}}
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">Click "Logout" to end your session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('body.scripts')
</body>

</html>
