(function ($) {
    $(document).ready(function(){

        // hide .navbar first

        // fade in .navbar
        if($(window).width()>768){
        $(function () {

            $( document ).on( "mousemove", function( event )  {

                // set distance user needs to scroll before we fadeIn navbar
                if (event.pageY <$('.navbar-custom').height()+$('.navbar-custom .dropdown-menu').height()) {
                    $('.navbar-custom').fadeIn();
                } else {
                    $('.navbar-custom').fadeOut();
                }


            }

            );


        });
        }
        else if(!$('.navbar-custom').isShown){
            $('.navbar-custom').fadeIn();
        }
    });
}(jQuery));
