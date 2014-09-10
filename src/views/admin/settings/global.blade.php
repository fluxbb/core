@extends('fluxbb::admin.layout.main')

@section('main')


    <div class="main">

      <div class="container">

        <h3>Global Settings</h3>

        <div class="tabbable tabs-left">

          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-essential" data-toggle="tab" class="text-center"><i class="icon-list-alt"></i> Essentials</a></li>
            <li><a href="#tab-time" data-toggle="tab" class="text-center"><i class="icon-time"></i> Time and timeouts</a></li>
            <li><a href="#tab-display" data-toggle="tab" class="text-center"><i class="icon-desktop"></i> Display</a></li>
            <li><a href="#tab-features" data-toggle="tab" class="text-center"><i class="icon-asterisk"></i> Features</a></li>
            <li><a href="#tab-reports" data-toggle="tab" class="text-center"><i class="icon-flag"></i> Reports</a></li>
            <li><a href="#tab-registration" data-toggle="tab" class="text-center"><i class="icon-terminal"></i> Registration</a></li>
          </ul> <!-- /nav-tabs -->

          <div class="tab-content">

            <div class="tab-pane active" id="tab-essential">
              <div class="fakeform">
            <!--<h4><i class="icon-list-alt"></i> Essentials</h4>-->
            <legend>Essentials</legend>
            <div class="inform">
                <fieldset>
                    <div class="infldset">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Board title</th>
                                    <td class="setting" data-old="{{{ $config->get('o_board_title') }}}">
                                        <input type="text" name="board_title" class="js-save-on-change" size="50" maxlength="255" value="{{{ $config->get('o_board_title') }}}">
                                        <span>The title of this bulletin board (shown at the top of every page). This field may <strong>not</strong> contain HTML.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Board description</th>
                                    <td class="setting" data-old="{{{ $config->get('o_board_desc') }}}">
                                        <input type="text" name="board_desc" class="js-save-on-change" size="50" maxlength="255" value="{{{ $config->get('o_board_desc') }}}">
                                        <span>A short description of this bulletin board (shown at the top of every page). This field may contain HTML.</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-time">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Time and timeouts</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">Default time zone</th>
                                    <td>
                                        <select name="form[default_timezone]">
                                            <option value="-12">(UTC-12:00) International Date Line West</option>
                                            <option value="-11">(UTC-11:00) Niue, Samoa</option>
                                            <option value="-10">(UTC-10:00) Hawaii-Aleutian, Cook Island</option>
                                            <option value="-9.5">(UTC-09:30) Marquesas Islands</option>
                                            <option value="-9">(UTC-09:00) Alaska, Gambier Island</option>
                                            <option value="-8.5">(UTC-08:30) Pitcairn Islands</option>
                                            <option value="-8">(UTC-08:00) Pacific</option>
                                            <option value="-7">(UTC-07:00) Mountain</option>
                                            <option value="-6">(UTC-06:00) Central</option>
                                            <option value="-5">(UTC-05:00) Eastern</option>
                                            <option value="-4">(UTC-04:00) Atlantic</option>
                                            <option value="-3.5">(UTC-03:30) Newfoundland</option>
                                            <option value="-3">(UTC-03:00) Amazon, Central Greenland</option>
                                            <option value="-2">(UTC-02:00) Mid-Atlantic</option>
                                            <option value="-1">(UTC-01:00) Azores, Cape Verde, Eastern Greenland</option>
                                            <option value="0" selected="selected">(UTC) Western European, Greenwich</option>
                                            <option value="1">(UTC+01:00) Central European, West African</option>
                                            <option value="2">(UTC+02:00) Eastern European, Central African</option>
                                            <option value="3">(UTC+03:00) Eastern African</option>
                                            <option value="3.5">(UTC+03:30) Iran</option>
                                            <option value="4">(UTC+04:00) Moscow, Gulf, Samara</option>
                                            <option value="4.5">(UTC+04:30) Afghanistan</option>
                                            <option value="5">(UTC+05:00) Pakistan</option>
                                            <option value="5.5">(UTC+05:30) India, Sri Lanka</option>
                                            <option value="5.75">(UTC+05:45) Nepal</option>
                                            <option value="6">(UTC+06:00) Bangladesh, Bhutan, Yekaterinburg</option>
                                            <option value="6.5">(UTC+06:30) Cocos Islands, Myanmar</option>
                                            <option value="7">(UTC+07:00) Indochina, Novosibirsk</option>
                                            <option value="8">(UTC+08:00) Greater China, Australian Western, Krasnoyarsk</option>
                                            <option value="8.75">(UTC+08:45) Southeastern Western Australia</option>
                                            <option value="9">(UTC+09:00) Japan, Korea, Chita, Irkutsk</option>
                                            <option value="9.5">(UTC+09:30) Australian Central</option>
                                            <option value="10">(UTC+10:00) Australian Eastern</option>
                                            <option value="10.5">(UTC+10:30) Lord Howe</option>
                                            <option value="11">(UTC+11:00) Solomon Island, Vladivostok</option>
                                            <option value="11.5">(UTC+11:30) Norfolk Island</option>
                                            <option value="12">(UTC+12:00) New Zealand, Fiji, Magadan</option>
                                            <option value="12.75">(UTC+12:45) Chatham Islands</option>
                                            <option value="13">(UTC+13:00) Tonga, Phoenix Islands, Kamchatka</option>
                                            <option value="14">(UTC+14:00) Line Islands</option>
                                        </select>
                                        <span>The default time zone for guests and users attempting to register for the board.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Adjust for DST</th>
                                    <td class="setting">
                                        <input type="checkbox" name="default_dst" class="js-save-on-change" value="1" />
                                        <span class="clearb">Check if daylight savings is in effect (advances times by 1 hour).</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Time format</th>
                                    <td>
                                        <input type="text" name="form[time_format]" size="25" maxlength="25" value="H:i:s">
                                        <span>[Current format: 10:55:28]. See <a href="http://www.php.net/manual/en/function.date.php">PHP manual</a> for formatting options.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Date format</th>
                                    <td>
                                        <input type="text" name="form[date_format]" size="25" maxlength="25" value="Y-m-d">
                                        <span>[Current format: 2013-07-06]. See <a href="http://www.php.net/manual/en/function.date.php">PHP manual</a> for formatting options.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Visit timeout</th>
                                    <td>
                                        <input type="text" name="form[timeout_visit]" size="5" maxlength="5" value="1800">
                                        <span>Number of seconds a user must be idle before his/hers last visit data is updated (primarily affects new message indicators).</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Online timeout</th>
                                    <td>
                                        <input type="text" name="form[timeout_online]" size="5" maxlength="5" value="300">
                                        <span>Number of seconds a user must be idle before being removed from the online users list.</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-display">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Display</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">Make clickable links</th>
                                    <td class="setting">
                                        <input type="checkbox" name="make_links" class="js-save-on-change" value="1" />
                                        <span class="clearb">When enabled, FluxBB will automatically detect any URLs in posts and make them clickable hyperlinks.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Topics per page</th>
                                    <td>
                                        <input type="text" name="form[disp_topics_default]" size="3" maxlength="2" value="30">
                                        <span>The default number of topics to display per page in a forum. Users can personalize this setting.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Posts per page</th>
                                    <td>
                                        <input type="text" name="form[disp_posts_default]" size="3" maxlength="2" value="25">
                                        <span>The default number of posts to display per page in a topic. Users can personalize this setting.</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-features">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Features</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">Users online</th>
                                    <td class="setting">
                                        <input type="checkbox" name="users_online" class="js-save-on-change" value="1" />
                                        <span class="clearb">Display info on the index page about guests and registered users currently browsing the board.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><a name="signatures"></a>Signatures</th>
                                    <td class="setting">
                                        <input type="checkbox" name="signatures" class="js-save-on-change" value="1" />
                                        <span class="clearb">Allow users to attach a signature to their posts.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">User has posted earlier</th>
                                    <td class="setting">
                                        <input type="checkbox" name="show_dot" class="js-save-on-change" value="1" />
                                        <span class="clearb">This feature displays a dot in front of topics in viewforum.php in case the currently logged in user has posted in that topic earlier. Disable if you are experiencing high server load.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Topic views</th>
                                    <td class="setting">
                                        <input type="checkbox" name="topic_views" class="js-save-on-change" value="1" />
                                        <span class="clearb">Keep track of the number of views a topic has. Disable if you are experiencing high server load in a busy forum.</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-reports">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Reports</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody><tr>
                                    <th scope="row">Reporting method</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[report_method]" value="0">&nbsp;<strong>Internal</strong></label>
                                        <label class="conl"><input type="radio" name="form[report_method]" value="1" checked="checked">&nbsp;<strong>Email</strong></label>
                                        <label class="conl"><input type="radio" name="form[report_method]" value="2">&nbsp;<strong>Both</strong></label>
                                        <span class="clearb">Select the method for handling topic/post reports. You can choose whether topic/post reports should be handled by the internal report system, emailed to the addresses on the mailing list (see below) or both.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Mailing list</th>
                                    <td>
                                        <textarea name="form[mailing_list]" rows="5" cols="55">webmaster@onenagros.org</textarea>
                                        <span>A comma separated list of subscribers. The people on this list are the recipients of reports.</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-registration">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Registration</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody><tr>
                                    <th scope="row">Allow new registrations</th>
                                    <td class="setting">
                                        <input type="checkbox" name="regs_allow" class="js-save-on-change" value="1" />
                                        <span class="clearb">Controls whether this board accepts new registrations. Disable only under special circumstances.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Verify registrations</th>
                                    <td class="setting">
                                        <input type="checkbox" name="regs_verify" class="js-save-on-change" value="1" />
                                        <span class="clearb">When enabled, users are emailed a random password when they register. They can then log in and change the password in their profile if they see fit. This feature also requires users to verify new email addresses if they choose to change from the one they registered with. This is an effective way of avoiding registration abuse and making sure that all users have "correct" email addresses in their profiles.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Report new registrations</th>
                                    <td class="setting">
                                        <input type="checkbox" name="regs_report" class="js-save-on-change" value="1" />
                                        <span class="clearb">If enabled, FluxBB will notify users on the mailing list (see above) when a new user registers in the forums.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">User forum rules</th>
                                    <td class="setting">
                                        <input type="checkbox" name="rules" class="js-save-on-change" value="1" />
                                        <span class="clearb">When enabled, users must agree to a set of rules when registering (enter text below). The rules will always be available through a link in the navigation table at the top of every page.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Enter your rules here</th>
                                    <td>
                                        <textarea name="form[rules_message]" rows="10" cols="55"></textarea>
                                        <span>Here you can enter any rules or other information that the user must review and accept when registering. If you enabled rules above you have to enter something here, otherwise it will be disabled. This text will not be parsed like regular posts and thus may contain HTML.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Default email setting</th>
                                    <td>
                                        <span>Choose the default privacy setting for new user registrations.</span>
                                        <label><input type="radio" name="form[default_email_setting]" id="form_default_email_setting_0" value="0">&nbsp;Display email address to other users.</label>
                                        <label><input type="radio" name="form[default_email_setting]" id="form_default_email_setting_1" value="1" checked="checked">&nbsp;Hide email address but allow form e-mail.</label>
                                        <label><input type="radio" name="form[default_email_setting]" id="form_default_email_setting_2" value="2">&nbsp;Hide email address and disallow form email.</label>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

          </div> <!-- /tab-content -->

        </div> <!-- /tabbable -->

      </div> <!-- /container -->

    </div> <!-- /main -->

@stop
