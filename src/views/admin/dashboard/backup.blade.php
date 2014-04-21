@extends('fluxbb::admin.layout.main')

@section('main')

    <!-- begin main div -->
    <div class="main">

        <!-- begin container -->
        <div class="container">

                <h3>Backup</h3>

                <div class="row">

                    <div class="col-md-8">

                        <h4>About backup</h4>
                        <div class="dashbox">
                            <p>One of the most important, but often ignored, practices is keeping a regular backup of your forum. It is impossible to estimate when disaster may strike, whether it be hardware failure, file corruption, human error or anything else.</p>
                            <p>It is important to note that keeping a backup of the files you uploaded is not enough, you also need to regularly backup your forum database.</p>
                        </div>

                    </div>

                    <div class="col-md-4 dashbox-backup">
                        <h4>Backup archives</h4>
                        <div class="dashbox">
                            <h5><i class="icon-cloud-download"></i> Latest backup</h5>
                            <p>The last backup was: 2 days ago.</p>
                            <div class="text-center">
                                <p><a href="#" class="btn btn-xs btn-success">Download again <i class="icon-download-alt"></i></a> or </p>
                                <p><a href="#" class="btn btn-xs btn-info">Generate new backup <i class="icon-download-alt"></i></a></p>
                                <p><small><small>New backup is recommended.</small></small></p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h4>Backup tools</h4>

                        <div class="dashbox">

                            <div class="tabbable tabs-left" style="margin-bottom: 18px;">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Default backup</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Custom backup</a></li>
                                </ul>
                                <div class="tab-content" style="">
                                    <div class="tab-pane active" id="tab1">
                                        <p>This is the most basic backup mode. Since it generates a copy of the entire FluxBB database, the resulting file can be very large especially if your forum contains a large number of posts and/or allows search cache.</p>
                                        <p class="text-center"><a href="#" class="btn btn-large btn-info"><i class="icon-download-alt"></i> Download <small style="display:block">full backup</small></a></p>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <p>Select muliple database table to export. For exemple f you just need to backup messages and users select <em>users</em>, <em>posts</em>, <em>topics</em> and <em>forums</em> tables.</p>
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <select multiple class="form-control col-md-4">
                                                    <option value="bans">bans</option>
                                                    <option value="categories">categories</option>
                                                    <option value="config">config</option>
                                                    <option value="forums">forums</option>
                                                    <option value="forum_perms">forum_perms</option>
                                                    <option value="groups">groups</option>
                                                    <option value="online">online</option>
                                                    <option value="posts">posts</option>
                                                    <option value="ranks">ranks</option>
                                                    <option value="reports">reports</option>
                                                    <option value="search_cache">search_cache</option>
                                                    <option value="search_matches">search_matches</option>
                                                    <option value="search_words">search_words</option>
                                                    <option value="topic_subscriptions">topic_subscriptions</option>
                                                    <option value="forum_subscriptions">forum_subscriptions</option>
                                                    <option value="topics">topics</option>
                                                    <option value="users">users</option>
                                                </select>
                                            </div>
                                        </div>
                                        <p class="text-center"><a href="#" class="btn btn-large btn-success"><i class="icon-download-alt"></i> Download <small style="display:block">custom backup</small></a></p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <h4>Import tool <sup>beta</sup></h4>
                        <div class="dashbox">
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Caution!</strong> Doing this will erase unbackuped data, don't do this unless you're absolutely sure you know what you're doing!
                            </div>
                            <p class="text-center"><input type="file" /> <a href="#" class="btn btn-large btn-success"><i class="icon-upload-alt"></i> Import <small style="display:block">select file</small></a></p>
                        </div>

                    </div>
                </div>

            </div>
            <!-- end container -->

        </div>
        <!-- end main div -->

@stop
