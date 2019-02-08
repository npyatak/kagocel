
$(document).on('click', '.button_play', function(e) {
	if($(this).hasClass('trackLeft')) {
		var track = leftTrack;
		$('.button_play.trackLeft').removeClass('active');
	} else {
		var track = rightTrack;
		$('.button_play.trackRight').removeClass('active');
	}

    $(this).addClass("active");

    track.loadNewTrack($(this).closest('li').data('url'));
    track.togglePlayback();
});

$(document).on('click', '.play_stop', function(e) {
    var track = $(this).hasClass('trackLeft') ? leftTrack : rightTrack;
    track.togglePlayback();
});

