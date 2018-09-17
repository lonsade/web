$(document).ready(function(){
	$('.skills-h').hover(function(){
		var skill = $('.skill_helper[alt="'+$(this).attr('alt')+'"]');
		skill.css({top: $(this).offset().top + 'px', left: ($(this).position().left + $(this).width() + 25) + 'px'});
		skill.children('.shower').css({top:  ($(this).height() - skill.children('.shower').height())/2 + 'px'});
		skill.stop();
		skill.fadeIn(100);
	},function(){
		$('.skill_helper[alt="'+$(this).attr('alt')+'"]').stop();
		$('.skill_helper[alt="'+$(this).attr('alt')+'"]').fadeOut(100);
	});
});