@layout('fluxbb::layout.main')

@section('main')
	<?php $currentItem = 'Personal'; ?>

	<div id="profile" class="block2col">
		@include('fluxbb::user.profile.menu')
		<div class="blockform">
			<h2><span>Personal</span></h2>
			<div class="box">
				<?php //TODO: unhardcode core, suggestion: adding a config file which holds the base url which the user wants to use. Always use that value (also in routes.php) ?>
				{{ Form::open('core/profile/'.$user->id.'/personal', 'PUT', array('id' => 'profile2', 'onsubmit' => 'return process_form(this)')) }}
					<div class="inform">
						<fieldset>
							<legend>Enter your personal details</legend>
							<div class="infldset">
								<input type="hidden" name="form_sent" value="1">
								<label>Real name<br>{{ Form::text('realname', $user->realname, array('size' => '40', 'maxlength' => '40')) }}<br></label>
								<label>Title <em>(Leave blank to use forum default.)</em><br>{{ Form::text('title', $user->title, array('size' => '30', 'maxlength' => '50')) }}<br></label>
								<label>Location<br>{{ Form::text('location', $user->location, array('size' => '30', 'maxlength' => '30')) }}<br></label>
								<label>Website<br>{{ Form::text('url', $user->url, array('size' => '50', 'maxlength' => '80')) }}<br></label>
							</div>
						</fieldset>
					</div>
					<p class="buttons">{{ Form::submit('Submit', array('name' => 'update')) }} When you update your profile, you will be redirected back to this page.</p>
				{{ Form::close() }}
			</div>
		</div>
		<div class="clearer"></div>
	</div>
@endsection