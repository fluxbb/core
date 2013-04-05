@extends('fluxbb::admin.layout.main')

@section('main')

<h2>Global settings</h2>

<div class="setting" data-key="board_title">
	<label>Board title</label>
	<input type="text" name="board_title" />
</div>

<div class="setting" data-key="board_description">
	<label>Description</label>
	<input type="text" name="board_description" />
</div>

<div class="setting">
	<label>Default language</label>
	<select name="default_language">
		<option value="en">English</option>
	</select>
</div>

<div class="setting">
	<label>Admin email</label>
	<input type="email" name="admin_email" />
</div>

<div class="setting">
	<label>Webmaster email</label>
	<input type="email" name="webmaster_email" />
</div>

@stop
