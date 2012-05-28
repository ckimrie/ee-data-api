<?php if(ENVIRONMENT == "production" || ENVIRONMENT == "testing"): ?>
    <link rel="stylesheet" href="assets/build/css/styles-min.css" />
<?php else: ?>
    <link rel="stylesheet" href="assets/src/css/jquery.mobile.css" />
    <link rel="stylesheet" href="assets/src/css/clip.css" />
<?php endif; ?>