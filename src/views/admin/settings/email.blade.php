@extends('fluxbb::admin.layout.main')

@section('main')

    <!-- begin main div -->
    <div class="main">

        <!-- begin container -->
        <div class="container">


            <h3>Email Settings</h3>

                <!-- begin dashbox -->
                <div class="dashbox">

                    <div class="inform">
                        <fieldset>
                            <div class="infldset">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Admin email</th>
                                            <td class="form-inline">
                                                <div class="form-group"><input class="form-control" type="text" name="form[admin_email]" size="50" maxlength="80" value="exemple@exemple.com"></div>
                                                <p>The email address of the board administrator.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Webmaster email</th>
                                            <td class="form-inline">
                                                <div class="form-group"><input class="form-control" type="text" name="form[webmaster_email]" size="50" maxlength="80" value="exemple@exemple.com"></div>
                                                <p>This is the address that all emails sent by the board will be addressed from.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Forum subscriptions</th>
                                            <td class="setting">
                                                <input type="checkbox" name="forum_subscriptions" class="js-save-on-change" value="1" />
                                                <p class="clearb">Enable users to subscribe to forums (receive email when someone creates a new topic).</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Topic subscriptions</th>
                                            <td class="setting">
                                                <input type="checkbox" name="topic_subscriptions" class="js-save-on-change" value="1" />
                                                <p class="clearb">Enable users to subscribe to topics (receive email when someone replies).</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">SMTP server address</th>
                                            <td class="form-inline">
                                                <div class="form-group"><input class="form-control" type="text" name="form[smtp_host]" size="30" maxlength="100" value=""></div>
                                                <p>The address of an external SMTP server to send emails with. You can specify a custom port number if the SMTP server doesn't run on the default port 25 (example: mail.myhost.com:3580). Leave blank to use the local mail program.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">SMTP username</th>
                                            <td class="form-inline">
                                                <div class="form-group"><input class="form-control" type="text" name="form[smtp_user]" size="25" maxlength="50" value=""></div>
                                                <p>Username for SMTP server. Only enter a username if it is required by the SMTP server (most servers <strong>do not</strong> require authentication).</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">SMTP password</th>
                                            <td class="form-inline">
                                                <label><input type="checkbox" name="form[smtp_change_pass]" value="1">&nbsp;Check this if you want to change or delete the currently stored password.</label>
                                                <div class="form-group"><input class="form-control" type="password" name="form[smtp_pass1]" size="25" maxlength="50" value=""></div>
                                                <div class="form-group"><input class="form-control" type="password" name="form[smtp_pass2]" size="25" maxlength="50" value=""></div>
                                                <p>Password for SMTP server. Only enter a password if it is required by the SMTP server (most servers <strong>do not</strong> require authentication). Please enter your password twice to confirm.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Encrypt SMTP using SSL</th>
                                            <td class="setting">
                                                <input type="checkbox" name="smtp_ssl" class="js-save-on-change" value="1" />
                                                <p class="clearb">Encrypts the connection to the SMTP server using SSL. Should only be used if your SMTP server requires it and your version of PHP supports SSL.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <!-- end dashbox -->

            </div>
            <!-- end container -->

        </div>
        <!-- end main div -->

@stop
