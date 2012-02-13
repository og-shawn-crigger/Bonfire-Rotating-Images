$.subscribe('list-view/list-item/click', function(id) {
	$('#content').load('<?php echo site_url(SITE_AREA .'/content/rotating_images/edit') ?>/'+ id);
});

$(function() {
	$( ".sortable" ).sortable({
		update: update_order,
		placeholder: "ui-state-highlight"
	}).disableSelection();
});

function update_order(event, ui) {
	order = new Array();
	$('tr', this).each(function(){
		order.push( $(this).find('input[name="action_to[]"]').val() );
	});
	order = order.join(',');

	$.post('/<?php echo SITE_AREA;?>/content/rotating_images/ajax_update_positions', { order: order }, function() {
		$('tr').removeClass('alt');
		$('tr:even').addClass('alt');
	});
}

<?php
/*
 Uncomment this section if you use datatables sortable tables
$("#flex_table").dataTable({
		"sDom": '<"top"fpi>rt',
		"sPaginationType": "listbox",
		"bProcessing": true,
		"bLengthChange": false,
		"iDisplayLength": <?php echo config_item('site.list_limit') ? config_item('site.list_limit') : 15; ?>,
		"aaSorting": [[3,'desc']],
		"bAutoWidth": false
    });
    
*/
?>