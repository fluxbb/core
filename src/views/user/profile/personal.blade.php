@extends('fluxbb::layout.main')

@section('main')

    <div id="profile" class="block2col">
        @include('fluxbb::user.profile.menu')
        <div class="blockform">
            <h2><span>Personal</span></h2>
            <div class="box">
                <form action="{{ route('profile', array('id' => $user->id, 'action' => 'personal')) }}" method="post">
                    <div class="inform">
                        <fieldset>
                            <legend>Enter your personal details</legend>
                            <div class="infldset">
                                <label>Real name<br><input type="text" name="realname" size="40" maxlength="40" value="{{ $user->realname }}" /><br></label>
                                <label>Title <em>(Leave blank to use forum default.)</em><br><input type="text" name="title" size="30" maxlength="50" value="{{ $user->title }}" /><br></label>
                                <label>Location<br><input type="text" name="location" size="30" maxlength="30" value="{{ $user->location }}" /><br></label>
                                <label>Website<br><input type="text" name="url" size="50" maxlength="80" value="{{ $user->url }}" /><br></label>
                            </div>
                        </fieldset>
                    </div>
                    <p class="buttons"><input type="submit" value="Submit" /> When you update your profile, you will be redirected back to this page.</p>
                </form>
            </div>
        </div>
        <div class="clearer"></div>
    </div>
@stop