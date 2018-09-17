<script type="text/javascript" src="../../jquery-3.0.0.min.js"></script>

<div>click</div>

<script type="text/javascript">
	$('div').click(function(){
		$.ajax({
			type: 'POST',
			url: 'handler.php',
			//data: $(this).parent('#form_creating').serialize()+'&'+data_levels+'&'+about_skills+data_items+'id_hero='+$('.name_hero').text(),
			success: function(data){
				//location.hash = 'all';
				alert(data);
			}
		});
	});
</script>