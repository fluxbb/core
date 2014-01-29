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
            <li><a href="#tab-syndication" data-toggle="tab" class="text-center"><i class="icon-rss"></i> Syndication</a></li>
            <li><a href="#tab-reports" data-toggle="tab" class="text-center"><i class="icon-flag"></i> Reports</a></li>
            <li><a href="#tab-avatars" data-toggle="tab" class="text-center"><i class="icon-picture"></i> Avatars</a></li>
            <li><a href="#tab-registration" data-toggle="tab" class="text-center"><i class="icon-terminal"></i> Registration</a></li>
            <li><a href="#tab-announcement" data-toggle="tab" class="text-center"><i class="icon-bullhorn"></i> Announcements</a></li>
            <li><a href="#tab-maintenance" data-toggle="tab" class="text-center"><i class="icon-bell-alt"></i> Maintenance</a></li>
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
                                    <td>
                                        <input type="text" name="form[board_title]" size="50" maxlength="255" value="OnEnAGros! − LE forum des fans de Kaamelott">
                                        <span>The title of this bulletin board (shown at the top of every page). This field may <strong>not</strong> contain HTML.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Board description</th>
                                    <td>
                                        <input type="text" name="form[board_desc]" size="50" maxlength="255" value="">
                                        <span>A short description of this bulletin board (shown at the top of every page). This field may contain HTML.</span>
                                    </td>
                                </tr>
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
                                    <td>
                                        <label class="conl"><input type="radio" name="form[default_dst]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[default_dst]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Check if daylight savings is in effect (advances times by 1 hour).</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Default language</th>
                                    <td>
                                        <select name="form[default_lang]">
                                            <option value="English">English</option>
                                            <option value="French" selected="selected">French</option>
                                        </select>
                                        <span>The default language for guests and users who haven't changed from the default in their profile. If you remove a language pack, this must be updated.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Default style</th>
                                    <td>
                                        <select name="form[default_style]">
                                            <option value="OnEnAGros-v4.3">OnEnAGros-v4.3</option>
                                            <option value="OnEnAGros-v4.4">OnEnAGros-v4.4</option>
                                            <option value="OnEnAGros-v5" selected="selected">OnEnAGros-v5</option>
                                            <option value="OnEnAGros-v5-aube">OnEnAGros-v5-aube</option>
                                            <option value="OnEnAGros-v5-nuit">OnEnAGros-v5-nuit</option>
                                        </select>
                                        <span>The default style for guests and users who haven't changed from the default in their profile.</span>
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
                                <tbody><tr>
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
                                <tr>
                                    <th scope="row">Redirect time</th>
                                    <td>
                                        <input type="text" name="form[redirect_delay]" size="3" maxlength="3" value="1">
                                        <span>Number of seconds to wait when redirecting. If set to 0, no redirect page will be displayed (not recommended).</span>
                                    </td>
                                </tr>
                            </tbody></table>
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
                                    <th scope="row">User info in posts</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[show_user_info]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[show_user_info]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Show information about the poster under the username in topic view. The information affected is location, register date, post count and the contact links (email and URL).</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">User post count</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[show_post_count]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[show_post_count]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Show the number of posts a user has made (affects topic view, profile and user list).</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Make clickable links</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[make_links]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[make_links]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">When enabled, FluxBB will automatically detect any URLs in posts and make them clickable hyperlinks.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Topic review</th>
                                    <td>
                                        <input type="text" name="form[topic_review]" size="3" maxlength="3" value="15">
                                        <span>Maximum number of posts to display when posting (newest first). Set to 0 to disable.</span>
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
                                    <td>
                                        <label class="conl"><input type="radio" name="form[users_online]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[users_online]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Display info on the index page about guests and registered users currently browsing the board.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><a name="signatures"></a>Signatures</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[signatures]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[signatures]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Allow users to attach a signature to their posts.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">User has posted earlier</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[show_dot]" value="1">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[show_dot]" value="0" checked="checked">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">This feature displays a dot in front of topics in viewforum.php in case the currently logged in user has posted in that topic earlier. Disable if you are experiencing high server load.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Topic views</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[topic_views]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[topic_views]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Keep track of the number of views a topic has. Disable if you are experiencing high server load in a busy forum.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Search all forums</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[search_all_forums]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[search_all_forums]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">When disabled, searches will only be allowed in one forum at a time. Disable if server load is high due to excessive searching.</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-syndication">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Syndication</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody><tr>
                                    <th scope="row">Default feed type</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[feed_type]" value="0" checked="checked">&nbsp;<strong>None</strong></label>
                                        <label class="conl"><input type="radio" name="form[feed_type]" value="1">&nbsp;<strong>RSS</strong></label>
                                        <label class="conl"><input type="radio" name="form[feed_type]" value="2">&nbsp;<strong>Atom</strong></label>
                                        <span class="clearb">Select the type of syndication feed to display. Note: Choosing none will not disable feeds, only hide them by default.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Duration to cache feeds</th>
                                    <td>
                                        <select name="form[feed_ttl]">
                                            <option value="0" selected="selected">Don't cache</option>
                                            <option value="5">5 minutes</option>
                                            <option value="15">15 minutes</option>
                                            <option value="30">30 minutes</option>
                                            <option value="60">60 minutes</option>
                                        </select>
                                        <span>Feeds can be cached to lower the resource usage of feeds.</span>
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

            <div class="tab-pane" id="tab-avatars">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Avatars</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody><tr>
                                    <th scope="row">Use avatars</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[avatars]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[avatars]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">When enabled, users will be able to upload an avatar which will be displayed under their title.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Upload directory</th>
                                    <td>
                                        <input type="text" name="form[avatars_dir]" size="35" maxlength="50" value="img/avatars">
                                        <span>The upload directory for avatars (relative to the FluxBB root directory). PHP must have write permissions to this directory.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Max width</th>
                                    <td>
                                        <input type="text" name="form[avatars_width]" size="5" maxlength="5" value="140">
                                        <span>The maximum allowed width of avatars in pixels (60 is recommended).</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Max height</th>
                                    <td>
                                        <input type="text" name="form[avatars_height]" size="5" maxlength="5" value="140">
                                        <span>The maximum allowed height of avatars in pixels (60 is recommended).</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Max size</th>
                                    <td>
                                        <input type="text" name="form[avatars_size]" size="6" maxlength="6" value="32000">
                                        <span>The maximum allowed size of avatars in bytes (10240 is recommended).</span>
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
                                    <td>
                                        <label class="conl"><input type="radio" name="form[regs_allow]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[regs_allow]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Controls whether this board accepts new registrations. Disable only under special circumstances.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Verify registrations</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[regs_verify]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[regs_verify]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">When enabled, users are emailed a random password when they register. They can then log in and change the password in their profile if they see fit. This feature also requires users to verify new email addresses if they choose to change from the one they registered with. This is an effective way of avoiding registration abuse and making sure that all users have "correct" email addresses in their profiles.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Report new registrations</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[regs_report]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[regs_report]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">If enabled, FluxBB will notify users on the mailing list (see above) when a new user registers in the forums.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">User forum rules</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[rules]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[rules]" value="0">&nbsp;<strong>No</strong></label>
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

            <div class="tab-pane" id="tab-announcement">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Announcements</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody><tr>
                                    <th scope="row">Display announcement</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[announcement]" value="1" checked="checked">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[announcement]" value="0">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">Enable this to display the below message in the board.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Announcement message</th>
                                    <td>
                                        <textarea name="form[announcement_message]" rows="5" cols="55"></textarea>
                                        <span>This text will not be parsed like regular posts and thus may contain HTML.</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-maintenance">
              <div class="fakeform">
                <div class="inform">
                    <fieldset>
                        <legend>Maintenance</legend>
                        <div class="infldset">
                            <table class="table">
                                <tbody><tr>
                                    <th scope="row"><a name="maintenance"></a>Maintenance mode</th>
                                    <td>
                                        <label class="conl"><input type="radio" name="form[maintenance]" value="1">&nbsp;<strong>Yes</strong></label>
                                        <label class="conl"><input type="radio" name="form[maintenance]" value="0" checked="checked">&nbsp;<strong>No</strong></label>
                                        <span class="clearb">When enabled, the board will only be available to administrators. This should be used if the board needs to be taken down temporarily for maintenance. <strong>WARNING! Do not log out when the board is in maintenance mode.</strong> You will not be able to login again.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Maintenance message</th>
                                    <td>
                                        <textarea name="form[maintenance_message]" rows="5" cols="55"></textarea>
                                        <span>The message that will be displayed to users when the board is in maintenance mode. If left blank, a default message will be used. This text will not be parsed like regular posts and thus may contain HTML.</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </fieldset>
                </div>
                <p class="submitend"><input type="submit" name="save" value="Save changes"></p>
              </div>
            </div>

          </div> <!-- /tab-content -->

        </div> <!-- /tabbable -->

      </div> <!-- /container -->

    </div> <!-- /main -->

@stop
