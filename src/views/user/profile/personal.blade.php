@extends('fluxbb::layout.main')

@section('main')

<div id="profile" class="block2col">
    @include('fluxbb::user.profile.menu')
    <div class="blockform">
        <h2><span>{{ trans('fluxbb::profile.section_personal') }}</span></h2>
            <div class="box">
                <form action="{{ route('profile', array('id' => $user->id, 'action' => 'personal')) }}" method="post">
                    <div class="inform">
                        <fieldset>
                            <legend>{{ trans('fluxbb::profile.personal_details_legend') }}</legend>
                            <div class="infldset">
                                <label>{{ trans('fluxbb::profile.realname') }}<br><input type="text" name="realname" size="40" maxlength="40" value="{{ $user->realname }}" /><br></label>
                                <label>{{ trans('fluxbb::profile.title') }} <em>({{ trans('fluxbb::profile.leave_blank') }})</em><br><input type="text" name="title" size="30" maxlength="50" value="{{ $user->title }}" /><br></label>
                                <label>{{ trans('fluxbb::profile.location') }}<br><input type="text" name="location" size="30" maxlength="30" value="{{ $user->location }}" /><br></label>
                                <label>{{ trans('fluxbb::profile.website') }}<br><input type="text" name="url" size="50" maxlength="80" value="{{ $user->url }}" /><br></label>
                            </div>
                        </fieldset>
                    </div>
                    <p class="buttons"><input type="submit" value="{{ trans('fluxbb::common.submit') }}" /> {{ trans('fluxbb::profile.instructions') }}</p>
                </form>
            </div>
        </div>
        <div class="clearer"></div>
    </div>
@stop
