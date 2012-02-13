<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/rotating_images/create'); ?>">
		<?php echo lang('rotating_images_create_new_button'); ?>
	</a>

	<h3><?php echo lang('rotating_images_create_new'); ?></h3>

	<p><?php echo lang('rotating_images_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Rotating-Images</h2>
	<table id="flex_table">
		<thead>
			<tr>
			
		<th>Title</th>
		<th>Image</th>
<!--		<th>Order</th> -->
		<th style="text-align:center;">Active</th>
		
			<th style="text-align:center;"><?php echo lang('rotating_images_actions'); ?></th>
			</tr>
		</thead>
		<tbody class="sortable">
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo form_hidden('action_to[]', $record->id); ?><?php echo $record->caption?></td>
				<td style="text-align:center;"><?php echo $record->image?></td>
<!--				<td><?php echo $record->weight?></td> -->
				<td style="text-align:center;"><?php echo yes_no ($record->active);?></td>
				<td  style="text-align:center;">
        <?php echo anchor(SITE_AREA .'/content/rotating_images/edit/'. $record->id, lang('rotating_images_edit'), ''); ?> | 
        <?php
          $js = lang('rotating_images_delete_confirm');
          $js = array(' onclick' => "return confirm('{$js}')");
          echo anchor(SITE_AREA .'/content/rotating_images/delete/'.  $record->id, lang('rotating_images_delete'), $js );
        ?>
        </td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>