$('.change-view-icon').click(function(){
    // Show the right icon
    $('#large, #small').toggleClass('d-none');

    if (this.id === "small") {
        $('.dashboard-list-item').removeClass('d-md-flex').addClass('w-48')
        $('.toggable-list').addClass('d-flex flex-wrap justify-content-between')

        // Make content stretch over card
        $('.dashboard-list-item').children().removeClass('col-md-4')
    } else {
        // Get back to the original state
        $('.dashboard-list-item').addClass('d-md-flex').removeClass('w-48')
        $('.toggable-list').removeClass('d-flex flex-wrap justify-content-between')

        $('.dashboard-list-item').children().addClass('col-md-4')
    }
});