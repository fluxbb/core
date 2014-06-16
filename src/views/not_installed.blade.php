<!DOCTYPE html>

<html>
<head>
    <title>FluxBB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- begin css -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />" />
    <!-- end css -->

    <!-- begin js -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- end js -->


</head>

<body>

    <!-- begin navbar -->
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">

        <div class="navbar-header">
            <a href="#" class="navbar-brand">FluxBB</a>
        </div>

    </nav>
    <!-- end navbar -->

    <!-- begin container -->
    <div class="container">

        <div class="alert alert-danger">
            <strong>Not Installed</strong>
            <p>It looks like FluxBB has not been installed yet.</p>
            <p>Please <a href="{{ URL::to('install') }}">run the installer</a> in order to get started.</p>
        </div>

    </div>
    <!-- end container -->

</body>
