
<div class="view split-view">
	
	<!-- Rotating-Images List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['rotating_images_name']) ? $record['id'] : $record['rotating_images_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['rotating_images_description']) ? lang('rotating_images_edit_text') : $record['rotating_images_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('rotating_images_no_records'); ?> <?php echo anchor(SITE_AREA .'/content/rotating_images/create', lang('rotating_images_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- Rotating-Images Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/rotating_images/create')?>"><?php echo lang('rotating_images_create_new_button');?></a>

				<h3><?php echo lang('rotating_images_create_new');?></h3>

				<p><?php echo lang('rotating_images_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>Rotating-Images</h2>
	<table>
		<thead>
			<tr>
		<th>Title</th>
		<th>Image</th>
		<th>Order</th>
		<th>Active</th>
		<th><?php echo lang('rotating_images_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->rotating_images_caption?></td>
				<td><?php echo $record->rotating_images_image?></td>
				<td><?php echo $record->rotating_images_weight?></td>
				<td><?php echo $record->rotating_images_active?></td>
				<td><?php echo anchor(SITE_AREA .'/content/rotating_images/edit/'. $record->id, lang('rotating_images_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
