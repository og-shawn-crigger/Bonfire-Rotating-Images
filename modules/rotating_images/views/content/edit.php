
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php
  endif; 
  if ( isset($rotating_images) )
    $rotating_images = (array)$rotating_images;

  $id = isset($rotating_images['id']) ? "/".$rotating_images['id'] : '';

  echo form_open_multipart($this->uri->uri_string(), 'class=""'); 

  if (isset($rotating_images['id']) ) 
    echo '<input id="id" type="hidden" name="id" value="' . $rotating_images['id'] . '"  />' . PHP_EOL;
    
  if(isset($rotating_images['rotating_images'])): ?>
  <input id="rotating_images" type="hidden" name="rotating_images" value="<?php echo set_value('rotating_images', isset($rotating_images['rotating_images']) ? $rotating_images['rotating_images'] : ''); ?>"  />
<?php
  endif;
?>

<div>
  <?php echo form_label('Title', 'caption'); ?> <span class="required">*</span>
  <input id="caption" type="text" name="caption" maxlength="255" value="<?php echo set_value('caption', isset($rotating_images['caption']) ? $rotating_images['caption'] : ''); ?>"  />
</div>

<div>
  <label for="fileupload">Image</label>
  <input id="fileupload" type="file" name="fileupload" value=""  />
</div>

<div>
  <?php echo form_label('Order', 'weight'); ?> <span class="required">*</span>
  <input id="weight" type="text" name="weight" maxlength="3" value="<?php echo set_value('weight', isset($rotating_images['weight']) ? $rotating_images['weight'] : ''); ?>"  />
</div>

<div>
  <label for="active">Active</label>
  <input type="checkbox" class="iphone-ui" id="active" name="active" value="1" <?php echo (isset($rotating_images['active']) && $rotating_images['active'] == 1) ? 'checked="checked"' : set_checkbox('active', 1); ?>>
</div>


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Edit Rotating-Images" /> or <?php echo anchor(SITE_AREA .'/content/rotating_images', lang('rotating_images_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/content/rotating_images/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('rotating_images_delete_confirm'); ?>')"><?php echo lang('rotating_images_delete_record'); ?></a>
		<h3><?php echo lang('rotating_images_delete_record'); ?></h3>
	</div>
