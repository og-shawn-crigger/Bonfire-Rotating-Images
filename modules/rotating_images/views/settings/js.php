$.subscribe('list-view/list-item/click', function(id) {
	$('#content').load('<?php echo site_url(SITE_AREA .'/settings/rotating_images/edit') ?>/'+ id);
});