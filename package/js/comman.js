
/*For header menu active class*/
$(function () {
    $('ul.nav li ').on('click', function () {
        $(this).parent().find('li.active').removeClass('active');
        $(this).addClass('active');
    });
});
/*For toggle menu*/
$("#menu-close").click(function (e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});
$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});
/*For get astrologer id and set hidden field in booking popup form*/
$(document).ready(function () {
    $('body').delegate('#book_now', 'click', function () {
        var astrologerId = $(this).attr('astrologyId');//get astrologer id
        $('#astrologer_id').val(astrologerId);//For set hidden field of astrologer id
    });
});
 
 /* product page pagination*/
function displayRecords(numRecords, pageNum,cat_id,latest) {
    $.ajax({
        type: "GET",
        url: baseUrl + "/ajax/Product_with_pagination",
        data: "show=" + numRecords + "&pagenum=" + pageNum +"&cat_id=" +cat_id + "&latest=" +latest,
        cache: false,
        success: function (html) {
            $("#appendProduct").html(html);
            //  $('.loader').html('');
        }
    });
}


/*  For datetime pikcer */
function DateTimePicker() {
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    var hh = today.getHours();
    var min = today.getMinutes();
    if (min < 30) {
        min = '00';
    } else {
        min = '30';
    }
    if (hh < 10) {
        hh = '0' + hh
    }
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    var today = mm + '/' + dd + '/' + yyyy;
    var newTime = hh + ':' + min + ':00';
    $('#astrologer_date_time').datetimepicker({
        minDate: new Date(),
        step: 15,
        minTime: newTime
    });

}
 
