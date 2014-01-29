@extends('fluxbb::admin.layout.main')

@section('main')

<div class="main">

    <div class="container">

        <div class="row-fluid">

            <div class="span8 dashbox-report">
                <h4>Pending reports</h4>
                <div class="dashbox">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>By</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td>1</td>
                                <td>2013-07-02</td>
                                <td>Someone</td>
                                <td>Lorem ipsum si dolor amet…</td>
                                <td>
                                    <a href="#" data-toggle="tooltip" data-original-title="Edit"><i class="icon-external-link-sign"></i></a>
                                    <a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a>
                                </td>
                            </tr>
                            <tr class="error">
                                <td>2</td>
                                <td>2013-06-22</td>
                                <td>Someone</td>
                                <td>Lorem ipsum si dolor amet…</td>
                                <td>
                                    <a href="#" data-toggle="tooltip" data-original-title="Edit"><i class="icon-external-link-sign"></i></a>
                                    <a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a>
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>3</td>
                                <td>2013-06-21</td>
                                <td>Someone</td>
                                <td>Lorem ipsum si dolor amet…</td>
                                <td>
                                    <a href="#" data-toggle="tooltip" data-original-title="Edit"><i class="icon-external-link-sign"></i></a>
                                    <a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2013-06-18</td>
                                <td>Someone</td>
                                <td>Lorem ipsum si dolor amet…</td>
                                <td>
                                    <a href="#" data-toggle="tooltip" data-original-title="Edit"><i class="icon-external-link-sign"></i></a>
                                    <a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- /dashbox-report -->

            <div class="span4 dashbox-stats">
                <h4>Statistics</h4>
                <div class="row dashbox">
                    <div class="span4 text-center">
                        <h4><strong>172,405</strong></h4>
                        <h5>Posts</h5>
                    </div> <!-- /span4 -->
                    <div class="span4 text-center divide">
                        <h4><strong>2,040</strong></h4>
                        <h5>Topics</h5>
                    </div> <!-- /span4 -->
                    <div class="span4 text-center">
                        <h4><strong>724</strong></h4>
                        <h5>Users</h5>
                    </div> <!-- /span4 -->
                    <div class="span3 text-center stats">
                        <i class="icon-4x icon-signal"></i>
                    </div> <!-- /span3 -->
                    <div class="span8 text-center">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">View forum statistics</a></li>
                            <li><a href="#">View server statistics</a></li>
                        </ul>
                    </div> <!-- /span8 -->
                </div> <!-- /dashbox -->
            </div> <!-- /dashbox-stats -->

        </div> <!-- /row-fluid -->

        <div class="row-fluid">

            <div class="span4 dashbox-notes">
                <h4>Notes</h4>
                <div class="dashbox">
                    <h5><i class="icon-calendar"></i> Two days ago <a href="#" data-toggle="tooltip" data-original-title="Edit"><i class="icon-edit-sign"></i></a></h5>
                    <p>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae.</p>
                    <h5><i class="icon-calendar"></i> One week ago <a href="#" data-toggle="tooltip" data-original-title="Edit"><i class="icon-edit-sign"></i></a></h5>
                    <p>Gallia est omnis divisa in partes tres…</p>
                    <a href="#" class="btn btn-block btn-info">View all notes <i class="icon-chevron-right"></i></a>
                </div> <!-- /dashbox -->
            </div> <!-- /dashbox-notes -->

            <div class="span4 dashbox-backup">
                <h4>Backup</h4>
                <div class="dashbox">
                    <h5><i class="icon-cloud-download"></i> Latest backup</h5>
                    <p>The last backup was: 2 days ago.</p>
                    <p>
                        <a href="#" class="btn btn-mini btn-success">Download again <i class="icon-download-alt"></i></a>
                        <a href="#" class="btn btn-mini btn-info">Generate new backup <i class="icon-download-alt"></i></a>
                    </p>
                    <hr />
                </div> <!-- /dashbox -->
            </div> <!-- /dashbox-notes -->

            <div class="span4 dashbox-logs">
                <h4>Logs &amp; Notifications</h4>
                <div class="dashbox">
                    <table class="table">
                        <tbody>
                            <tr class="info">
                                <td><span class="badge badge-info"><i class="icon-info"></i></span></td>
                                <td>New user <strong>Stanley</strong> registered.</td>
                            </tr>
                            <tr class="warning">
                                <td><span class="badge badge-warning"><i class="icon-exclamation"></i></span></td>
                                <td>New user <strong>BadGuy</strong> password failed.</td>
                            </tr>
                            <tr class="error">
                                <td><span class="badge badge-important"><i class="icon-exclamation"></i></span></td>
                                <td>IP <strong>1.2.3.4</strong> tried to log as admin (4 attempts).</td>
                            </tr>
                            <tr class="success">
                                <td><span class="badge badge-success"><i class="icon-ok"></i></span></td>
                                <td>Daily backup completed successfully.</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- /dashbox -->
            </div> <!-- /dashbox-notes -->

        </div> <!-- /row-fluid -->

    </div> <!-- /container -->

</div> <!-- /main -->

@stop
