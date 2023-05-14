$(document).ready(function () {
    // function to show our popups
    function showPopup(whichpopup) {
        var docHeight = $(document).height(); //grab the height of the page
        var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
        $('.overlay-bg').show().css({'height': docHeight}); //display your popup background and set height to the page height
        $('.popup' + whichpopup).show().css({'top': scrollTop + 20 + 'px'}); //show the appropriate popup and set the content 20px from the window top

    }

    // function to close our popups
    function closePopup(val) {
        $('.overlay-bg, .overlay-content').hide(); //hide the overlay
        if (val != ''){
            showPopup(val);
        }
    }

    // timer if we want to show a popup after a few seconds.
    //get rid of this if you don't want a popup to show up automatically
    setTimeout(function () {
        showPopup(1);
        // Show popup show
    }, 100);

   /* setTimeout(function(){
        localStorage.removeItem("popState");
    }, 1000*60);*/


    // show popup when you click on the link
    $('.show-popup').click(function (event) {
        event.preventDefault(); // disable normal link function so that it doesn't refresh the page
        var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show

        showPopup(selectedPopup); //we'll pass in the popup number to our showPopup() function to show which popup we want
    });

    // prevents the overlay from closing if user clicks outside the popup overlay
    $('.overlay-bg').click(function () {
        return false;
    });

    // hide popup when user clicks on close button or if user clicks anywhere outside the container
    $('.close-btn').click(function () {
        var pid = $(this).attr('id');
        closePopup(pid);
    });

    // hide the popup when user presses the esc key
    $(document).keyup(function (e) {
        if (e.keyCode == 27) { // if user presses esc key
            closePopup();
        }
    });
});