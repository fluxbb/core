<div class="blockmenu">
    <h2><span>Profile menu</span></h2>
    <div class="box">
        <div class="inbox">
            <ul>
                @foreach($items as $key => $text)
                    @if ($key == $action)
                        <li class="isactive"><a href="{{ route('profile', array('id' => $user->id, 'action' => $key)) }}">{{ $text }}</a></li>
                    @else
                        <li><a href="{{ route('profile', array('id' => $user->id, 'action' => $key)) }}">{{ $text }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>