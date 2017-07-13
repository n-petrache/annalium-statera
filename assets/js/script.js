/*
 En cliquant sur un portrait de personnage :
 la div .characters disparaît en glissant,
 et la div #chara apparaît en glissant
 */
$(".characters").click(function () {
    $(".characters").slideUp();
    $(this).next(".chara").slideDown();
});
$(".back").click(function () {
    $(".chara").slideUp();
    $(".characters").slideDown();
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
