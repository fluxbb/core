@extends('fluxbb::...layout.main')

@section('main')

<div class="main">

			<div class="container">

				<h3>Forums &amp; Categories</h3>

				<div class="dashbox">

					<table class="table">
						<tr>
						<td><h4>Add new Forum / Categorie</h4></td>
						</tr>
						<tr>
							<td>
								<table class="table table-striped">
									<tbody>
										<tr>
											<td><input class="form-control" type="text" placeholder="Title" /></td>
											<td><select class="form-control" name="type" style="width:12em"><option value="0" selected="selected">Forum</option><option value="1">Categorie</option></select></td>
											<td><select class="form-control" name="sort_by" style="width:12em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" class="btn btn-success"><strong>Add new <i class="icon-plus"></i></strong></a></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><h4>FluxBB</h4></td>
						</tr>
						<tr>
							<td>
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>1</td>
											<td><input class="form-control" type="text" value="Announcements" /></td>
											<td><textarea class="form-control" style="height:3em">The really important stuff.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td><input class="form-control" type="text" value="FluxBB discussion" /></td>
											<td><textarea class="form-control" style="height:3em">Any other FluxBB related discussion.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
										<tr>
											<td>3</td>
											<td><input class="form-control" type="text" value="Core development" /></td>
											<td><textarea class="form-control" style="height:3em">Mainly for discussion among developers regarding the FluxBB core.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
										<tr>
											<td>4</td>
											<td><input class="form-control" type="text" value="Feature requests" /></td>
											<td><textarea class="form-control" style="height:3em">Something we've missed adding in the core? Post it here.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
										<tr>
											<td>5</td>
											<td><input class="form-control" type="text" value="Show off" /></td>
											<td><textarea class="form-control" style="height:3em">Let us see what you've done with FluxBB.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
						<td><h4>1.4 / 1.5 Support</h4></td>
						</tr>
						<tr>
							<td>
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>1</td>
											<td><input class="form-control" type="text" value="General support (1.4 / 1.5)" /></td>
											<td><textarea class="form-control" style="height:3em">Any 1.4 / 1.5 related questions in here.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td><input class="form-control" type="text" value="Modifications (1.4 / 1.5)" /></td>
											<td><textarea class="form-control" style="height:3em">Discussion of mods and plugins for 1.4 / 1.5. Upload mods.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
										<tr>
											<td>3</td>
											<td><input class="form-control" type="text" value="Styles (1.4 / 1.5)" /></td>
											<td><textarea class="form-control" style="height:3em">Discussion of styles for FluxBB 1.4 / 1.5. Upload styles.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
						<td><h4>1.2 Support</h4></td>
						</tr>
						<tr>
							<td>
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>1</td>
											<td><input class="form-control" type="text" value="General support (1.2)" /></td>
											<td><textarea class="form-control" style="height:3em">Any 1.2 related questions in here.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td><input class="form-control" type="text" value="Modifications (1.2)" /></td>
											<td><textarea class="form-control" style="height:3em">Discussion of mods and plugins for 1.2. Upload mods.</textarea></td>
											<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
											<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><h4>General</h4></td>
						</tr>
						<tr>
							<td>
								<table class="table table-striped">
								<tbody>
									<tr>
										<td></td>
										<td><input class="form-control" type="text" value="General discussion" /></td>
										<td><textarea class="form-control" style="height:3em">Any discussion unrelated to FluxBB.</textarea></td>
										<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
										<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
									</tr>
									<tr>
										<td></td>
										<td><input class="form-control" type="text" value="Programming" /></td>
										<td><textarea class="form-control" style="height:3em">Discuss any kind of computer programming in here.</textarea></td>
										<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
										<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
									</tr>
									<tr>
										<td></td>
										<td><input class="form-control" type="text" value="Test board" /></td>
										<td><textarea class="form-control" style="height:3em">Feel free to try things out.</textarea></td>
										<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
										<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
									</tr>
								</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><h4>Archive</h4></td>
						</tr>
						<tr>
							<td>
								<table class="table table-striped">
								<tbody>
									<tr>
										<td></td>
										<td><input class="form-control" type="text" value="Bugs" /></td>
										<td><textarea class="form-control" style="height:3em">Old bugs from before our ticket system.</textarea></td>
										<td><select class="form-control" name="sort_by" style="width:8em"><option value="0" selected="selected">Last post</option><option value="1">Topic start</option><option value="2">Subject</option></select></td>
										<td><a href="#" data-toggle="tooltip" data-original-title="Move"><i class="icon-move"></i></a><a href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-remove"></i></a><a href="#" data-toggle="tooltip" data-original-title="Permissions"><i class="icon-key"></i></a></td>
									</tr>
								</tbody>
								</table>
							</td>
						</tr>
					</table>

				</div>

			</div> <!-- /container -->

		</div> <!-- /main -->

@stop
