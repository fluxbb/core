@extends('fluxbb::admin.layout.main')

@section('main')

	<!-- begin main div -->
	<div class="main">
		
		<!-- begin container -->
		<div class="container">

				<h3>Maintenance Settings</h3>

				<!-- begin dashbox -->
				<div class="dashbox">

					<div class="inform">
						<h4>Maintenance</h4>
						<fieldset>
							<div class="infldset">
								<p>If you've added, edited or removed posts manually in the database or if you're having problems searching, you should rebuild the search index. For best performance, you should put the forum in <a href="admin_options.php#maintenance">maintenance mode</a> during rebuilding. <strong>Rebuilding the search index can take a long time and will increase server load during the rebuild process!</strong></p>
								<table class="table">
									<tbody>
										<tr>
											<th scope="row">Posts per cycle</th>
											<td class="form-inline">
												<p>The number of posts to process per pageview. E.g. if you were to enter 300, three hundred posts would be processed and then the page would refresh. This is to prevent the script from timing out during the rebuild process.</p>
												<div class="form-group"><input class="form-control" type="text" value="300" /></div>
											</td>
										</tr>
										<tr>
											<th scope="row">Starting post ID</th>
											<td class="form-inline">
												<p>The post ID to start rebuilding at. The default value is the first available ID in the database. Normally you wouldn't want to change this.</p>
												<div class="form-group"><input class="form-control" type="text" /></div>
											</td>
										</tr>
										<tr>
											<th scope="row">Empty index</th>
											<td class="inputadmin">
												<label><input type="checkbox" value="1" checked="checked">&nbsp;&nbsp;Select this if you want the search index to be emptied before rebuilding (see below).</label>
											</td>
										</tr>
									</tbody>
								</table>
								<p>Once the process has completed, you will be redirected back to this page. It is highly recommended that you have JavaScript enabled in your browser during rebuilding (for automatic redirect when a cycle has completed). If you are forced to abort the rebuild process, make a note of the last processed post ID and enter that ID+1 in "Starting post ID" when/if you want to continue ("Empty index" must not be selected).</p>
							</div>
						</fieldset>
					</div>
					<p class="text-center"><input type="submit" class="btn btn-success" value="Rebuild index"></p>

				</div> 
				<!-- end dashbox -->
				
			</div> 
			<!-- end container -->

		</div>
		<!-- end main div -->
   
@stop
