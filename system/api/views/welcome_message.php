<!DOCTYPE html> 
<html class="ui-mobile"> 
    <head> 
    <title>Clip Lead Capture</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <?php $this->load->view("embeds/css"); ?>
</head> 
<body> 



<!-- Login Page -->

<div data-role="page"  id="login">
    <div data-role="header">
        <h1>Clip Lead Capture</h1>
    </div><!-- /header -->
    <div data-role="content">   
        <form action="#" id="loginForm">
            <label for="basic">Email Address</label>
            <input type="email" name="name" id="emailAddress" value="<?php echo $email ?>"  />

            <input type="submit" id="loginBtn" data-role="button" value="Start"/>
        </form>
    </div><!-- /content -->
</div><!-- /page -->





<!-- Default Form -->
<div data-role="page" id="capture">
    <div data-role="header">
        <h1>Clip</h1>
        <a href="#optionsDialog" 
            class="ui-btn-right" 
            data-icon="gear" 
            data-transition="none">Options</a>
    </div><!-- /header -->
    <div data-role="content">   
        <?php $this->load->view("forms/default") ?>
    </div><!-- /content -->
</div><!-- /page -->



<!-- History -->
<div data-role="page" id="history" data-add-back-btn="true">
    <div data-role="header">
        <h1>History</h1>
        <a href="#optionsDialog" 
            class="ui-btn-right" 
            data-icon="gear" 
            data-transition="none">Options</a>
    </div><!-- /header -->
    <div data-role="content">   
        <ul data-role="listview" id="historyList" >
        </ul>
    </div><!-- /content -->
</div><!-- /page -->






<!-- Generic Dialog Message -->
<div data-role="dialog" id="errorDialog">
    <div data-role="header"  data-position="inline">
        <h1>Error</h1>
    </div>
    <div data-role="content" >
        <div class="content"></div>
        <a href="#" data-role="button" data-rel="back">Ok</a>
    </div>
</div>


<!-- Generic Dialog Message -->
<div data-role="dialog" id="success">
    <div data-role="header"  data-position="inline">
        <h1>Success</h1>
    </div>
    <div data-role="content" >
        <div class="content" class="ui-body">
            <div class="successIcon">&#10003;</div>
            <div class="successMsg">Data successfully saved.</div>
        </div>
    </div>
</div>


<!-- Options Dialog  -->
<div data-role="dialog" id="optionsDialog">
    <div data-role="header" data-position="inline">
        <h1>Options</h1>
    </div>
    <div data-role="content">
        <a href="#capture" data-role="button">Capture</a>
        <a href="#history" data-role="button">History</a>
        <a href="#" data-role="button" data-theme="b" id="signOutBtn">Sign out</a>
    </div>
</div>


<?php $this->load->view("embeds/js"); ?>
</body>
</html>