<form action="#" method="post" data-transition="flip" data-prevent-transition="1" id="<?php echo isset($lead['data']) ? "updateForm" : "captureForm"; ?>" data-form-id="default" data-lead-id="<?php echo @$lead['id'] ?>" >

        <div data-role="fieldcontain">
             <label for="name">Name:</label>
             <input type="text" name="name" id="name" value="<?php echo  @$lead['data']['name'] ?>" />
        </div>

        <div data-role="fieldcontain">
             <label for="email">Email:</label>
             <input type="email" name="email" id="email" value="<?php echo  @$lead['data']['email'] ?>" />
        </div>

        <div data-role="fieldcontain">
             <label for="company">Company:</label>
             <input type="text" name="company" id="company" value="<?php echo  @$lead['data']['company'] ?>" />
        </div>

        <div data-role="fieldcontain">
         <label for="title">Job Title:</label>
         <input type="text" name="title" id="title" value="<?php echo  @$lead['data']['title'] ?>" />
        </div>

        <div data-role="fieldcontain">
             <label for="tel">Telephone:</label>
             <input type="tel" name="tel" id="tel" value="<?php echo  @$lead['data']['tel'] ?>" />
        </div>

        

        

        <div data-role="fieldcontain">
         <label for="rating">Rating:</label><br/>
         <input type="range" name="rating" id="rating" 
            value="<?php echo  isset($lead['data']['tel']) ? @$lead['data']['rating'] : 0; ?>" 
            min="0" 
            max="5" 
            step="1" 
            data-highlight="true"/>
        </div>

        

        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <legend>Gender:</legend>
                    <input type="radio" name="gender" id="gender-m" value="male" <?php if( @$lead['data']['gender'] == "male") { echo "checked='checked'"; } ?> />
                    <label for="gender-m">Male</label>

                    <input type="radio" name="gender" id="gender-f" value="female" <?php if( @$lead['data']['gender'] == "female") { echo "checked='checked'"; } ?> />
                    <label for="gender-f">Female</label>
            </fieldset>
        </div>

        <div data-role="fieldcontain">
        <label for="notes">Notes:</label>
        <textarea cols="40" rows="8" name="notes" id="notes" ><?php echo @$lead['data']['notes'] ?></textarea>
        </div>

     
    <div class="ui-body ui-body-b formSubmitButtons">
        <?php if(isset($lead['data'])): ?>
            <input type="submit" data-theme="b" data-icon="check"  data-inline="true" value="Update">
        <?php else: ?>
            <input type="submit" data-theme="b" data-icon="check"  data-inline="true" value="Submit">
            <a href="#" data-theme="c" data-icon="delete" data-inline="true" data-role="button" id="resetBtn">Reset</a>
        <?php endif; ?>
    </div>
</form>