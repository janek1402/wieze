$(document).ready(function() {
    $('#tn2').hide();
    $('#obrazekmacka').hide();


    $('#tn0').mouseover(function() {
        $('#tn1').hide();
        $('#cont').hide();
        $('#tn2').show();
        $('#obrazekmacka').show();
    }).mouseout(function() {
        $('#tn2').hide();
        $('#tn1').show();
        $('#cont').show();
        $('#obrazekmacka').hide();
    })
})