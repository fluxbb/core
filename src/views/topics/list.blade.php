<div class="row vfx-header">
    <div class="col-md-6 col-sm-6 col-xs-6">Topic</div>
    <div class="col-md-1 col-sm-1 col-xs-1">{{ trans('fluxbb::common.replies') }}</div>
    <div class="col-md-1 col-sm-1 col-xs-1">{{ trans('fluxbb::forum.views') }}</div>
    <div class="col-md-4 col-sm-4 col-xs-4">{{ trans('fluxbb::common.last_post') }}</div>
</div>

<!-- TODO: stickies -->

<!-- TODO: Icons -->

@if ($topics)

    @foreach ($topics as $topic)
        <div class="row vfx-content">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="{{ $route('topic', ['id' => $topic->id]) }}">{{ $topic->title }}</a>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">{{ '2' }}</div>
            <div class="col-md-1 col-sm-1 col-xs-1">{{ '0' }}</div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <a href="{{ $route('viewpost', array('id' => $topic->id)) }}#p{{ $topic->id }}">yesterday</a> <span class="byuser">{{ trans('fluxbb::common.by', array('author' => 'someone')) }}</span>
            </div>
        </div>
    @endforeach

@else
    <div class="row vfx-content">
        No topics.
    </div>
@endif
