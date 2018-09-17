$(document).ready(function(){
    setTimeout('$("#loader").hide(300)', 200);
    $('input[type="radio"], input[type="checkbox"]').checkboxradio({
        icon: false
    });
});