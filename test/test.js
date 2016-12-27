$(".myButton").click(function () {

    // Set the effect type
    var effect = 'slide';

    // Set the options for the effect type chosen
    var options = { direction: 'top' };

    // Set the duration (default: 400 milliseconds)
    var duration = this.id;

    $('#myDiv').toggle(effect, options, duration);
});
$(document).ready(function(){
    $(".myButton").click(function(){
        setTimeout(function(){
        $("#content_2").slideUp();
        },1000);
    });

});
