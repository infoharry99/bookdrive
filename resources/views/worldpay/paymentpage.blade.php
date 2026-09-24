<!DOCTYPE html>
<html>
    <head>
        <title>Payment Page</title>
        <script src="https://payments.worldpay.com/resources/hpp/integrations/embedded/js/hpp-embedded-integration-library.js"></script>
    </head>

    <body>
        <div>This is my payment page</div>
        <div id="custom-html"></div>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var customOptions = {
                    url: "{{ $paymentUrl}}",
                    type: 'iframe',
                    inject: 'onload',
                    target: 'custom-html',
                    accessibility: true,
                    debug: false,
                };
                var libraryObject = new WPCL.Library();
                libraryObject.setup(customOptions);
            });
        </script>
    </body>
</html>
