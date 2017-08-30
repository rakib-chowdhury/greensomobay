function checkNumber(id) {
    var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
    if (tmp_num == null || isNaN(tmp_num)) {
        var x = document.getElementById(id);
        x.value = x.value.replace(/[^0-9]/, '');
    }
}

$(document).ready(function () {
    $('#bloodGroup').selectize();
    $('#religion').selectize();
    $('#designation').selectize();
    $('#branch').selectize();
    $('#education').selectize();
    $('#role').selectize();

    $('#dob').datepicker();

    $("#image").change(function(e){

        var img = e.target.files[0];

        if(!img.type.match('image.*')){
            $('#image').val('');
            alert("Whoops! That is not an image.");
            return;
        }
        iEdit.open(img, true, function(res){
            $("#pictureView").attr("src", res).width(120).height(60);
        });
    });
    
    $("#nid").keyup(function () {
        checkNumber('nid');
    }).blur(function () {
        checkNumber('nid');
    }).mouseleave(function () {
        checkNumber('nid');
    });

    $("#mobile").keyup(function () {
        checkNumber('mobile');
    }).blur(function () {
        checkNumber('mobile');
    }).mouseleave(function () {
        checkNumber('mobile');
    });
});