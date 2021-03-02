var pages = {};
$( 'body' ).on("click",".btn_like",function(e) {
	e.preventDefault();
	var u = $(this).attr("href");
        var ob = this;
        $.get(u + '/ajax', function( my_var ) {
            if($(ob).hasClass("liked"))
                $(ob).removeClass("liked");
            else
                $(ob).addClass("liked");
        });
	return false;
});

$( 'body' ).on("click",".hook",function(e) {
	e.preventDefault();
        var state = { 'page_id': 1, 'user_id': 5 };
	var title = 'Hello World';
	var url = $(this).attr("href");
	var page_part = $(this).attr("data");
	history.pushState(state, title, url);
        if (!$('.navbar-toggler').hasClass('collapsed')){
            $('.navbar-toggler').click();
        }
	if (typeof pages[url] !== 'undefined') {
		$( '#page-content' ).html(pages[url]);
	}
	else
	{
            //$( '#page-content' ).html("");
            //$('footer').hide();
            //$('.loading').addClass('show');
            //setTimeout(function(){
            $.get(url + '/ajax', function( my_var ) {
                    //pages[url] = my_var;
                    if(!page_part)
                            $( '#page-content' ).html(my_var);
                    else
                            $( '.' + page_part ).html($(my_var).find('.' + page_part).html());
                    //$('.loading').removeClass('show');
                    //$('footer').show();
            });
            //}, 400);
	}
	return false;
});


var sound;
var domElement;
var index;
	$('body').on("click",".audio_row",function() {
		var currentsrc = $( this ).parent().find( ".player_audio" )[0].src
		if(typeof sound !== 'undefined' && sound.paused == false)
		{
			sound.pause();
			domElement.find( ".avatar" ).removeClass("rotate_back");
			domElement.find( ".audio_row" ).removeClass("audio_pause");
			
			if(sound.src !== currentsrc)
			{
				sound = new Audio(currentsrc);
				domElement = $( this ).parent();
				domElement.find( ".avatar" ).addClass( "rotate_back" );
				domElement.find( ".audio_row" ).addClass( "audio_pause" );
				sound.play();
			}
		}
		else
		{
			sound = new Audio(currentsrc);
			domElement = $( this ).parent();
			domElement.find( ".avatar" ).addClass( "rotate_back" );
			domElement.find( ".audio_row" ).addClass( "audio_pause" );
			sound.play();
		}
	});
$( document ).ready(function() {
	$('.loading').removeClass('show');
});