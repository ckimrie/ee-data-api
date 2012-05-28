<div data-role="page" data-add-back-btn="true"> 
    <div data-role="header">
        <h1>History</h1>
        <a href="#optionsDialog" 
            class="ui-btn-right" 
            data-icon="gear" 
            data-transition="none">Options</a>
    </div> 
    <div data-role="content">
        <?php $this->load->view("forms/default", array("lead", $lead)); ?>
    </div> 
</div> 