<section class="content-header">
    <h1>
        @hasSection('title')
        @yield('title')
        @endif
    </h1>
    <ol class="breadcrumb">
        {{-- <li><a href="#"><i class="fa fa-home"></i> Home</a></li> --}}
        <li class="active">
            @hasSection('link')
            @yield('link')
            @endif
        </li>
    </ol>
</section>