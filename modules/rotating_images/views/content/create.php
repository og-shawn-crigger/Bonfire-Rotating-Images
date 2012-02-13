
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
  <label for="caption">Title</label>
  <span class="required">*</span>
  <input id="caption" type="text" name="caption" maxlength="255" value="<?php echo set_value('caption', isset($rotating_images['caption']) ? $rotating_images['caption'] : ''); ?>"  />
</div>

<div>
  <label for="fileupload">Image</label>
  <input id="fileupload" type="file" name="fileupload" value=""  />
</div>

<div>
  <label for="weight">Order</label>
  <span class="required">*</span>
  <input id="weight" type="text" name="weight" maxlength="3" value="<?php echo set_value('weight', isset($rotating_images['weight']) ? $rotating_images['weight'] : ''); ?>"  />
</div>

<div>
  <label for="active">Active</label>
  <span class="required">*</span>
  <input type="checkbox" class="iphone-ui" id="active" name="active" value="1" <?php echo (isset($rotating_images['active']) && $rotating_images['active'] == 1) ? 'checked="checked"' : set_checkbox('active', 1); ?>>
	
</div>

	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create Rotating-Images" /> or <?php echo anchor(SITE_AREA .'/content/rotating_images', lang('rotating_images_cancel')); ?>
	</div>
</form>
