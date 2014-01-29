@extends('fluxbb::admin.layout.main')

@section('main')

    <!-- begin main div -->
    <div class="main">

        <!-- begin container -->
        <div class="container">

            <h3>FluxBB Updates</h3>

                <!-- begin dashbox -->
                <div class="dashbox">

                    <p>You are working with an old version of FluxBB! Please update to a newer version right away! You can download FluxBB and update manualy or let FluxBB update itself. You can also re-install your current installation.</p>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button class="btn btn-success">Download 1.5.3</button>
                            <button class="btn btn-success">Install 1.5.3</button>
                            <button class="btn btn-info">Re-install 1.5.2</button>
                        </div>
                    </div>
                    <h3>Plugin updates</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="150px">Name</th>
                                <th>Discription</th>
                                <th width="150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>EZBBC Toolbar</td>
                                <td>Version <b>1.6.0</b> is released, you are working with 1.5.3. 100% compatible according <a href="#">Jojaba</a>.</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-xs">Install 1.6.0</button>
                                        <button class="btn btn-warning btn-xs">Remove</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>FluxSmile</td>
                                <td>Version <b>5.0.0</b> is released, you are working with 4.2.0. 100% compatible according <a href="#">Studio 384</a>.</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-xs">Install 5.0.0</button>
                                        <button class="btn btn-warning btn-xs">Remove</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success">Update all plugins</button>
                    <h3>Template updates</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="150px">Name</th>
                                <th>Discription</th>
                                <th width="150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Air/Earth/Fire</td>
                                <td>Version <b>1.5.3</b> is released, you are working with 1.5.2. 100% compatible according <a href="#">FluxBB.org Developers</a>.</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-xs">Install 1.5.3</button>
                                        <button class="btn btn-warning btn-xs">Remove</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Victory</td>
                                <td>Version <b>1.0.2</b> is released, you are working with 1.0.1. 100% compatible according the <a href="#">orkneywd</a>.</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-xs">Install 1.0.2</button>
                                        <button class="btn btn-warning btn-xs">Remove</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Drogamleczna</td>
                                <td>Version <b>1.1.4</b> is released, you are working with 1.1. 100% compatible according the <a href="#">123</a>.</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-xs">Install 1.1.4</button>
                                        <button class="btn btn-warning btn-xs">Remove</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success">Update all templates</button>

                </div>
                <!-- end dashbox -->

            </div>
            <!-- end container -->

        </div>
        <!-- end main div -->

@stop
