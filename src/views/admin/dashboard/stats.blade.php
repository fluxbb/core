@extends('fluxbb::admin.layout.main')

@section('main')

    <!-- begin main div -->
    <div class="main">

            <!-- begin container -->
            <div class="container">

                <h3>Statistics</h3>

                <div class="dashbox">
                    <div class="graph-container">
                        <div id="hero-area" class="graph"></div>
                    </div>
                </div>

                <div class="dashbox">
                    <div class="graph-container">
                        <div id="hero-bar" class="graph" style="position: relative;"></div>
                    </div>
                </div>

            </div>
            <!-- end container -->

        </div>
        <!-- end main div -->

@stop
