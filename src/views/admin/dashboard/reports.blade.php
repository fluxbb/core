@extends('fluxbb::admin.layout.main')

@section('main')

    <!-- begin main div -->
    <div class="main">

        <!-- begin container -->
        <div class="container">

                <h3>Reports &amp; Spam</h3>

                <div class="dashbox">

                    <div class="blockform">
                        <h4>New reports</h4>
                        <div class="box">
                            <div class="fakeform">
                                <div class="inform">
                                    <fieldset>
                                        <legend>None</legend>
                                        <div class="infldset">
                                            <p>There are no new reports.</p>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="dashbox">

                    <div class="blockform block2">
                        <h4>10 last read reports</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>By</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="#">Julius Caesar</a></td>
                                    <td>17-01-2013</td>
                                    <td>Marked as read by <strong>Admin</strong></td>
                                    <td>
                                        <ul class="breadcrumb">
                                            <li><a href="#">Commentarii de bello Gallico</a> <span class="divider">/</span></li>
                                            <li class="active">Deleted <span class="divider">/</span></li>
                                            <li class="active">Deleted</li>
                                        </ul>
                                        <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td><a href="#">Julius Caesar</a></td>
                                    <td>08-01-2013</td>
                                    <td>Marked as read by <strong>Admin</strong></td>
                                    <td>
                                        <ul class="breadcrumb">
                                            <li><a href="#">Commentarii de bello Gallico</a> <span class="divider">/</span></li>
                                            <li><a href="#">Liber I</a> <span class="divider">/</span></li>
                                            <li class="active"><a href="#">Post #102676</a></li>
                                        </ul>
                                        <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td><a href="#">Julius Caesar</a></td>
                                    <td>07-06-2012 </td>
                                    <td>Marked as read by <strong>Admin</strong></td>
                                    <td>
                                        <ul class="breadcrumb">
                                            <li><a href="#">Commentarii de bello Gallico</a> <span class="divider">/</span></li>
                                            <li><a href="#">Liber I</a> <span class="divider">/</span></li>
                                            <li class="active"></li>
                                        </ul>
                                        <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td><a href="#">Julius Caesar</a></td>
                                    <td>21-05-2012</td>
                                    <td>Marked as read by <strong>Admin</strong></td>
                                    <td>
                                        <ul class="breadcrumb">
                                            <li><a href="#">Commentarii de bello Gallico</a> <span class="divider">/</span></li>
                                            <li><a href="#">Liber I</a> <span class="divider">/</span></li>
                                            <li class="active"></li>
                                        </ul>
                                        <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td><a href="#">Julius Caesar</a></td>
                                    <td>05-03-2012</td>
                                    <td>Marked as read by <strong>Admin</strong></td>
                                    <td>
                                        <ul class="breadcrumb">
                                            <li><a href="#">Commentarii de bello Gallico</a> <span class="divider">/</span></li>
                                            <li><a href="#">Liber I</a> <span class="divider">/</span></li>
                                            <li class="active"></li>
                                        </ul>
                                        <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td><a href="#">Julius Caesar</a></td>
                                    <td>26-05-2011 </td>
                                    <td>Marked as read by <strong>Admin</strong></td>
                                    <td>
                                        <ul class="breadcrumb">
                                            <li><a href="#">Commentarii de bello Gallico</a> <span class="divider">/</span></li>
                                            <li><a href="#">Liber I</a> <span class="divider">/</span></li>
                                            <li class="active"><a href="#">Post #82459</a></li>
                                        </ul>
                                        <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>7</td>
                                    <td><a href="#">Julius Caesar</a></td>
                                    <td>23-05-2011</td>
                                    <td>Marked as read by <strong>Admin</strong></td>
                                    <td>
                                        <ul class="breadcrumb">
                                            <li><a href="#">Commentarii de bello Gallico</a> <span class="divider">/</span></li>
                                            <li><a href="#">Liber I</a> <span class="divider">/</span></li>
                                            <li class="active"><a href="#">Post #82459</a></li>
                                        </ul>
                                        <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                
                    </div>

                </div>

            </div>
            <!-- end container -->

        </div> 
        <!-- end main div -->

@stop
