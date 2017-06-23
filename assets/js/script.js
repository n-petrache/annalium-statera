/*
 En cliquant sur la section Gallerie/Personnages :
 la div #taka perd sa class "content"
 la div #intro disparaît en glissant,
 et la div #taka apparaît en glissant
 */
$("#gal-chara").click(function () {
    $("#taka").removeClass("content");
    $(".content").slideUp();
    $("#taka").slideDown();
});
$(document).ready(function () {
    var sideslider = $('[data-toggle=collapse-side]');
    var sel = sideslider.attr('data-target');
    var sel2 = sideslider.attr('data-target-2');
    sideslider.click(function () {
        $(sel).toggleClass('in');
        $(sel2).toggleClass('out');
    });
});
