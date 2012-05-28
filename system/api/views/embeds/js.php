<?php if(ENVIRONMENT == "production" || ENVIRONMENT == "testing"): ?>
    <script src="assets/build/js/built-min.js"></script>
<?php else: ?>
    <script src="assets/src/js/requirejs/requirejs.js"></script>
    <script src="assets/src/js/jquery/jquery.js"></script>
    <script src="assets/src/js/jquery/jquery.mobile.js"></script>
<?php endif; ?>
    <script>
    // ==================================
    // = RequireJS config
    // ==================================
    require.config({
        baseUrl: "assets/src/js",
    })

    // ==================================
    // = Bootstrap
    // ==================================

    require(["jquery", "clip/config", "clip/App"], function ($, config, App) {

        config.set({
            siteUrl: "<?php echo site_url('/') ?>",
            environment: "<?php echo ENVIRONMENT ?>"
        })

        new App(config);
    })

    </script>