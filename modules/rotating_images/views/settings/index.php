<?php if (validation_errors()) : ?>
<div class="notification error">
	<p><?php echo validation_errors(); ?></p>
</div>
<?php endif; ?>

<?php echo form_open('admin/settings/rotating_images/edit')?>
  <fieldset style="margin-top: 15px;">
    <legend>Rotating Image Settings<em>(Leave trailing slash)</em></legend>
    <div>
        <label for="ri_directory">Upload Directory </label>
        <input type="text" name="ri_directory" id="ri_directory" value="<?php echo set_value('ri_directory', isset($ri_directory) ? $ri_directory : ''); ?>" />
    </div>
  </fieldset>

  <fieldset>
    <legend>Resize Information </legend>

    <div>
      <label for="ri_resize">Resize Images</label>
      <?php
        echo form_dropdown('ri_resize', array('0'=>'No','1'=>'Yes'),set_value('ri_resize', ( ( !empty($ri_resize) ) ? $ri_resize : 0 ) ),'id="ri_resize"' );
      ?>
    </div>

    <div>
        <label for="ri_height">Image Height</label>
        <input type="text" name="ri_height" id="ri_height" value="<?php echo set_value('ri_height', isset($ri_height) ? $ri_height : ''); ?>" />
    </div>
    <div>
        <label for="ri_width">Image Width</label>
        <input type="text" name="ri_width" id="ri_width" value="<?php echo set_value('ri_width', isset($ri_width) ? $ri_width : ''); ?>" />
    </div>

  </fieldset>

  <div class="submits">
    <input type="submit" name="submit" value="Save Settings" />
  </div>
<?php echo form_close()?>
