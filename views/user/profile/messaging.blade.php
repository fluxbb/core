@layout('fluxbb::layout.main')

@section('main')
	<?php $currentItem = 'Messaging'; ?>

	<div id="profile" class="block2col">
		@include('fluxbb::user.profile.menu')
		<div class="blockform">
			<h2><span>Messaging</span></h2>
			<div class="box">
				<?php //TODO: unhardcode core, suggestion: adding a config file which holds the base url which the user wants to use. Always use that value (also in routes.php) ?>
				{{ Form::open('core/profile/'.$user->id.'/messaging', 'PUT', array('id' => 'profile3', 'onsubmit' => 'return process_form(this)')) }}
					<div class="inform">
						<fieldset>
							<legend>Enter your messaging details</legend>
							<div class="infldset">
								<input type="hidden" name="form_sent" value="1">
								<label>Jabber<br>{{ Form::text('jabber', $user->jabber, array('size' => '40', 'maxlength' => '75', 'id' => 'jabber')) }}<br></label>
								<label>ICQ<br>{{ Form::text('icq', $user->icq, array('size' => '12', 'maxlength' => '12', 'id' => 'icq')) }}<br></label>
								<label>MSN Messenger<br>{{ Form::text('msn', $user->msn, array('size' => '40', 'maxlength' => '50', 'id' => 'msn')) }}<br></label>
								<label>AOL IM<br>{{ Form::text('aim', $user->aim, array('size' => '20', 'maxlength' => '30', 'id' => 'aim')) }}<br></label>
								<label>Yahoo! Messenger<br>{{ Form::text('yahoo', $user->yahoo, array('size' => '20', 'maxlength' => '30', 'id' => 'yahoo')) }}<br></label>
							</div>
						</fieldset>
					</div>
					<p class="buttons">{{ Form::submit('Submit', array('name' => 'update')) }} When you update your profile, you will be redirected back to this page.</p>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection