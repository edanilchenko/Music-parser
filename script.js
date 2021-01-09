jQuery(document).ready(function($) {
    var trackslist = [];
    var currenttrack = false;

    $('.track-save-link').each(function(i, e) {
        var track_id = $(e).data('id')
        var track_link = $(e).attr('href');
        trackslist[track_id] = track_link;
    });

    $('.track-play-button').click(function() {
        var button = $(this);
        if (!button.hasClass('playing')) {
            if (currenttrack) {
                currenttrack.pause();
            }
            currenttrack = new Audio(trackslist[button.data('id')]);
            $('i.icon-pause').removeClass('icon-pause').addClass('icon-play');
            $('.track-play-button.playing').removeClass('playing');
            button.addClass('playing');
            var icon = button.find('i');
            icon.removeClass('icon-play');
            icon.addClass('icon-pause');
            currenttrack.play();
        } else {
            button.removeClass('playing');
            var icon = button.find('i');
            icon.removeClass('icon-pause');
            icon.addClass('icon-play');
            currenttrack.pause();
        }
    });
});