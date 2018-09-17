
$('#setting #delete').click(function(){
	var guide = $(this).parents('.guide');
	$.ajax({
		type: 'POST',
		url: 'includes/my/delete.php',
		data: 'id=' + guide.attr('id').match(/\d{1,}/),
		success: function(){
			guide.animate({opacity: 0}, 300, function(){
				$(this).remove();
			});
		}
	});
});