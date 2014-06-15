@extends('fluxbb::layout.main')

@section('main')

<div id="profile" class="block2col">
    @include('fluxbb::user.profile.menu')
    <div class="blockform">
        <h2><span>{{ trans('fluxbb::profile.section_display') }}</span></h2>
        <div class="box">
            <form action="{{ route('profile', array('id' => $user->id, 'action' => 'display')) }}" method="post">
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.style_legend') }}</legend>
                        <div class="infldset">
                            <label>Styles<br>
                            <select name="style">
                                <option value="Air" selected="selected">Air</option>
                                <option value="Cobalt">Cobalt</option>
                                <option value="Earth">Earth</option>
                                <option value="Fire">Fire</option>
                                <option value="Lithium">Lithium</option>
                                <option value="Mercury">Mercury</option>
                                <option value="Oxygen">Oxygen</option>
                                <option value="Radium">Radium</option>
                                <option value="Sulfur">Sulfur</option>
                                <option value="Technetium">Technetium</option>
                            </select>
                            <br></label>
                        </div>
                    </fieldset>
                </div>
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.post_display_legend') }}</legend>
                        <div class="infldset">
                            <p>{{ trans('fluxbb::profile.post_display_info') }}</p>
                            <div class="rbox">
                                <label><input type="checkbox" name="show_smilies" value="1" checked="checked"> {{ trans('fluxbb::profile.show_smilies') }}<br></label>
                                <label><input type="checkbox" name="show_sig" value="1" checked="checked"> {{ trans('fluxbb::profile.show_sigs') }}<br></label>
                                <label><input type="checkbox" name="show_avatars" value="1" checked="checked"> {{ trans('fluxbb::profile.show_avatars') }}<br></label>
                                <label><input type="checkbox" name="show_img" value="1" checked="checked"> {{ trans('fluxbb::profile.show_images') }}<br></label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.pagination_legend') }}</legend>
                        <div class="infldset">
                            <label class="conl">{{ trans('fluxbb::profile.topics_per_page') }}<br><input type="text" name="disp_topics" value="" size="6" maxlength="3"><br></label>
                            <label class="conl">{{ trans('fluxbb::profile.posts_per_page') }}<br><input type="text" name="disp_posts" value="" size="6" maxlength="3"><br></label>
                            <p class="clearb">{{ trans('fluxbb::profile.paginate_info') }}</p>
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
