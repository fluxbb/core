</div>
<!-- end forum container -->

@if (isset($message))
    <script type="text/javascript">
        jQuery(function($) {
            var message = {{ json_encode($message) }};
            FluxBB.alert(message);
        });
    </script>
    <div class="alert alert-info hidden" id="alert-message">
        <button type="button" class="close js-hide-alert">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <p></p>
    </div>
@endif

</body>

</html>
