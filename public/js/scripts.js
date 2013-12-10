$(document).ready(function() {
    $("#navbar li.active").parents('li').addClass('active');
    $('a[rel=tooltip]').tooltip();
});
