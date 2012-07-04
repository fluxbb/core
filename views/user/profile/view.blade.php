@layout('fluxbb::layout.main')

@section('main')
<div id="viewprofile" class="block">
	<h2><span>Profile</span></h2>
	<div class="box">
		<div class="fakeform">
			<div class="inform">
				<fieldset>
				<legend>Personal</legend>
					<div class="infldset">
						<dl>
							<dt>Username</dt>
							<dd>{{$user->username}}</dd>
							@if (!empty($user->title))
								<dt>Title</dt>
								<dd>{{$user->title}}</dd>
							@endif
							@if (!empty($user->realname))
								<dt>Real name</dt>
								<dd>{{$user->realname}}</dd>
							@endif
							@if (!empty($user->location))
								<dt>Location</dt>
								<dd>{{$user->location}}</dd>
							@endif							
							@if (!empty($user->url))
								<dt>Website</dt>
								<dd><span class="website"><a href="adf">{{$user->url}}</a></span></dd>
							@endif
						</dl>
						<div class="clearer"></div>
					</div>
				</fieldset>
			</div>
			@if (!empty($user->jabber) || !empty($user->icq) || !empty($user->msn) || !empty($user->aim) || !empty($user->yahoo))
			<div class="inform">
				<fieldset>
				<legend>Messaging</legend>
					<div class="infldset">
						<dl>
							@if (!empty($user->jabber))
								<dt>Jabber</dt>
								<dd>{{$user->jabber}}</dd>
							@endif
							@if (!empty($user->icq))
								<dt>ICQ</dt>
								<dd>{{$user->icq}}</dd>
							@endif
							@if (!empty($user->msn))
								<dt>Real name</dt>
								<dd>{{$user->realname}}</dd>
							@endif
							@if (!empty($user->realname))
								<dt>Real name</dt>
								<dd>{{$user->realname}}</dd>
							@endif
							@if (!empty($user->realname))
								<dt>Real name</dt>
								<dd>{{$user->realname}}</dd>
							@endif
						</dl>
						<div class="clearer"></div>
					</div>
				</fieldset>
			</div>
			@endif
			@if (!empty($user->signature))
			<div class="inform">
				<fieldset>
				<legend>Personality</legend>
					<div class="infldset">
						<dl>
							<dt>Signature</dt>
							<dd><div class="postsignature postmsg"><p>{{$user->signature}}</p></div></dd>
						</dl>
						<div class="clearer"></div>
					</div>
				</fieldset>
			</div>
			@endif
			@if (!empty($user->num_posts)|| !empty($user->last_post) ||!empty($user->registered))
			<div class="inform">
				<fieldset>
				<legend>User activity</legend>
					<div class="infldset">
						<dl>
							<dt>Posts</dt>
							<dd>1 - <a href="search.php?action=show_user_topics&amp;user_id=2">Show all topics</a> - <a href="search.php?action=show_user_posts&amp;user_id=2">Show all posts</a></dd>
							<dt>Last post</dt>
							<dd>Today 10:21:54</dd>
							<dt>Registered</dt>
							<dd>Today</dd>
						</dl>
						<div class="clearer"></div>
					</div>
				</fieldset>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection