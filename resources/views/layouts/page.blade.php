@extends('layouts.master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body')
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    @include('layouts.navbar')

    @include('layouts.sidebar')
    
    <div class="content-wrapper">
        {{-- Content Header  --}}
        @hasSection ('content_header')
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('content_header')</h1>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('layouts.flash-message')
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>

    @include('layouts.footer')
</div>
@stop

@section('adminlte_js')
    @stack('js')
    <script>
    /*** add active class and stay opened when selected ***/
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).addClass('active');

    // for the treeview
    $('ul.nav-treeview a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    
    $('div.alert').delay(3000).fadeOut(350);
    </script>
    @yield('js')
@stop