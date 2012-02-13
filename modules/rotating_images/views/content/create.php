
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($rotating_images) ) {
	$rotating_images = (array)$rotating_images;
}
$id = isset($rotating_images['id']) ? "/".$rotating_images['id'] : '';
?>
<?php echo form_open_multipart($this->uri->uri_string(), 'class=""'); ?>
<?php

  if(isset($rotating_images['id'])):
?>

  <input id="id" type="hidden" name="id" value="<?php echo $rotating_images['id'];?>"  />

<?php

  endif;
  if ( isset ( $rotating_images['rotating_images']) ) :
?>
    <input id="rotating_images" type="hidden" name="rotating_images" value="<?php echo set_value('rotating_images', isset($rotating_images['rotating_images']) ? $rotating_images['rotating_images'] : ''); ?>"  />
<?php endif; ?>

<div>
  <label for="rotating_images_caption">Title</label>
  <span class="required">*</span>
  <input id="rotating_images_caption" type="text" name="rotating_images_caption" maxlength="255" value="<?php echo set_value('rotating_images_caption', isset($rotating_images['rotating_images_caption']) ? $rotating_images['rotating_images_caption'] : ''); ?>"  />
</div>

<div>
  <label for="fileupload">Image</label>
  <input id="fileupload" type="file" name="fileupload" value=""  />
</div>

<div>
  <label for="rotating_images_weight">Order</label>
  <span class="required">*</span>
  <input id="rotating_images_weight" type="text" name="rotating_images_weight" maxlength="3" value="<?php echo set_value('rotating_images_weight', isset($rotating_images['rotating_images_weight']) ? $rotating_images['rotating_images_weight'] : ''); ?>"  />
</div>

<div>
  <label for="rotating_images_active">Active</label>
  <span class="required">*</span>
  <input type="checkbox" class="iphone-ui" id="rotating_images_active" name="rotating_images_active" value="1" <?php echo (isset($rotating_images['rotating_images_active']) && $rotating_images['rotating_images_active'] == 1) ? 'checked="checked"' : set_checkbox('rotating_images_active', 1); ?>>
	
</div>

	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create Rotating-Images" /> or <?php echo anchor(SITE_AREA .'/content/rotating_images', lang('rotating_images_cancel')); ?>
	</div>
</form>
