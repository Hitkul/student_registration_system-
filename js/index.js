// var options = ['@bml.edu.in','@gmail.com'];
// $("input#user_email").autocomplete({
//     source: options
// });
// $("input#user_email").keyup(function() {
//     var new_options = [];
//     for (var i = 0; i < options.length; i++)
//         new_options[i] = $(this).val() + options[i];
//     $(this).autocomplete( "option", "source", new_options);
// });

$(document).ready(function(){
  function validateForm(){
    var x=document.forms["loginform"]["email"].value;
    // var y=document.forms["loginform"]["password"].value;
    if (x==null || x=="") {
      alert("Please enter email and password");
      return false;
    }
});
