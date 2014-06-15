@extends('fluxbb::layout.main')

@section('main')

<div id="profile" class="block2col">
    @include('fluxbb::user.profile.menu')
    <div class="blockform">
        <h2><span>{{ trans('fluxbb::profile.section_essentials') }}</span></h2>
        <div class="box">
            <form action="{{ route('profile', array('id' => $user->id, 'action' => 'essentials')) }}" method="post">
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.username_and_pass_legend') }}</legend>
                        <div class="infldset">
                            <input type="hidden" name="form_sent" value="1">
                            <label class="required"><strong>{{ trans('fluxbb::profile.username') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br>
                            @if ($user->isAdmin())
                                <input type="text" name="username" size="25" maxlength="25" value="{{ $user->username }}" />
                            @else {{ $user->username }}
                            @endif
                            <br></label>
                            <p class="actions"><span><a href="#">{{ trans('fluxbb::profile.change_password') }}</a></span></p>
                        </div>
                    </fieldset>
                </div>
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.email_legend') }}</legend>
                        <div class="infldset">
                            <label class="required"><strong>{{ trans('fluxbb::profile.email') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br><input type="text" name="email" size="40" maxlength="80" value="{{ $user->email }}" /><br></label><p><span class="email"><a href="misc.php?email=2">{{ trans('fluxbb::profile.send_email') }}</a></span></p>
                        </div>
                    </fieldset>
                </div>
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.localisation_legend') }}</legend>
                        <div class="infldset">
                            <p>{{ trans('fluxbb::profile.time_zone_info') }}</p>
                            <label>{{ trans('fluxbb::profile.time_zone') }}
                            <br><select name="timezone">
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
                            <br></label>
                            <div class="rbox">
                                <label><input type="checkbox" name="dst" value="1"> {{ trans('fluxbb::profile.dst') }}<br></label>
                            </div>
                            <label>{{ trans('fluxbb::profile.time_format') }}
                            <br><select name="time_format">
                                <option value="0" selected="selected">{{ date('h:i:s') }} {{ trans('fluxbb::common.default') }} / (Default)</option>
                                <option value="2">{{date('h:i') }}</option>
                                <option value="3">{{date('g:i:s a') }}</option>
                                <option value="4">{{date('g:i a') }}</option>
                            </select>
                            <br></label>
                            <label>{{ trans('fluxbb::profile.date_format') }}
                            <br><select name="date_format">
                                <option value="0" selected="selected">{{ date("Y-m-d") }} {{ trans('fluxbb::common.default') }} / (Default)</option>
                                <option value="2">{{ date("Y-d-m") }}</option>
                                <option value="3">{{ date("d-m-Y") }}</option>
                                <option value="4">{{ date("m-d-Y") }}</option>
                                <option value="5">{{ date("M j Y") }}</option>
                                <option value="6">{{ date("jS M Y") }}</option>
                            </select>
                            <br></label>

                        </div>
                    </fieldset>
                </div>
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.user_activity') }}</legend>
                        <div class="infldset">
                            <p>{{ $user_infos['registered'] }}</p>
                            <p>{{ $user_infos['last_post'] }}</p>
                            <p>{{ $user_infos['last_visit'] }}</p>
                            <label>{{ $user_infos['num_posts'] }}<br></label><p class="actions">
                            {{--- TODO: add input field for posts when admin + add links to controller actions --}}
                            <a href="search.php?action=show_user_topics&amp;user_id=2">{{ trans('fluxbb::profile.show_topics') }}</a> - <a href="search.php?action=show_user_posts&amp;user_id=2">{{ trans('fluxbb::profile.show_posts') }}</a> - <a href="search.php?action=show_subscriptions&amp;user_id=2">{{ trans('fluxbb::profile.show_subscriptions') }}</a></p>
                            @if ($user->isAdmin())
                            <label>{{ trans('fluxbb::profile.admin_note') }}<br>
                            <input type="text" name="admin_note" size="30" maxlength="30" value="{{ $user->admin_note }}" /><br></label>
                            @endif
                        </div>
                    </fieldset>
                </div>
                <p class="buttons"><input type="submit" name="update" value="{{ trans('fluxbb::common.submit') }}" /> {{ trans('fluxbb::profile.instructions') }}</p>
            </form>
        </div>
    </div>
    <div class="clearer"></div>
</div>
@stop
