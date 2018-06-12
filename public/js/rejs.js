// //reading image to the browser
// $(function () {
//     function readURL(input) {
//
//         if (input.files && input.files[0]) {
//             var reader = new FileReader();
//
//             reader.onload = function(e) {
//                 $('#defaultimage').attr('src', e.target.result);
//             }
//
//             reader.readAsDataURL(input.files[0]);
//         }
//     }
//
//     $("#userimage").change(function() {
//         readURL(this);
//     });
// });

    // $(function() {
    //     $("input:file").change(function (){
    //         alert("file is chosen");
    //     });
    // });

//end reading image

//start processing the Form

$(function () {
    $("#form1").submit(function () {
        var name = $("#name").val();
        var username = $('#username').val();
        var family = $("#family").val();
        var date = $("#bd").val();
        var nac = $("#nac").val();
        var pass = $("#pass").val();
        var passconf = $("#passconf").val();
        var email = $("#email").val();
        var cell = $("#cell").val();
        var bd = $('#bd').val();
        var dateReg = /^\d{4}[./-]\d{2}[./-]\d{2}$/;
        if($.trim(name) === '') {$("#namewarn").css('display','block');return false;}
        if($.trim(family) === '') {$("#familywarn").css('display','block');return false;}
        if($.trim(username) === '') {$("#usernamewarn").css('display','block');return false;}
        if($.trim(date) === '') {$("#bd").attr('placeholder','تاریخ را وارد کنید مانند 1367/06/29');return false}
        if(!bd.match(dateReg)) {$("#bdwarn").css('display','block');return false;}
        if(nac.length < 10) {$("#nacwarnmore").css('display','none');$("#nacwarn").css('display','block');return false;}
        if(nac.length > 10) {$("#nacwarnmore").css('display','block');$("#nacwarn").css('display','none');return false;}
        if($('#gen option:selected').prop('disabled') === true) {$("#genwarn").css('display','block');return false;}
        if($.trim(email) === '' ) {$("#emailwarn").css('display','block');return false}
        if(cell.length < 11) {$("#cellwarnmore").css('display','none');$("#cellwarn").css('display','block');return false;}
        if(cell.length > 11) {$("#cellwarnmore").css('display','block');$("#cellwarn").css('display','none');return false;}if($.trim(pass) === '' ) {$("#passwarn").css('display','block');return false}
        if($.trim(passconf) === '' ) {$("#passconfwarn").css('display','block');return false}
        if($.trim(pass) !== $.trim(passconf)) {$("#passconfwarn").css('display','block');return false}

    });
});

$(function () {
    $("#updateform").submit(function () {
        var name = $("#name").val();
        var family = $("#family").val();
        var date = $("#bd").val();
        var nac = $("#nac").val();
        var email = $("#email").val();
        var cell = $("#cell").val();
        var bd = $("#bd").val();
        var dateReg = /^\d{4}[./-]\d{2}[./-]\d{2}$/;
        if(!bd.match(dateReg)) {$("#bdwarn").css('display','block');return false;}
        // !nac.match(/^\d+$/)
        if($.trim(name) === '') {$("#namewarn").css('display','block');return false;}
        if($.trim(family) === '') {$("#familywarn").css('display','block');return false;}
        if($.trim(date) === '') {$("#bd").attr('placeholder','تاریخ را وارد کنید مانند 1367/06/29');return false}
        if(nac.length < 10) {$("#nacwarnmore").css('display','none');$("#nacwarn").css('display','block');return false;}
        if(nac.length > 10) {$("#nacwarnmore").css('display','block');$("#nacwarn").css('display','none');return false;}
        if(cell.length < 11) {$("#cellwarnmore").css('display','none');$("#cellwarn").css('display','block');return false;}
        if(cell.length > 11) {$("#cellwarnmore").css('display','block');$("#cellwarn").css('display','none');return false;}
        if($.trim(email) === '' ) {$("#emailwarn").css('display','block');return false}
    });
});

$(function () {
    $("#passchangeform").submit(function () {
        var pass = $("#pass").val();
        var passconf = $("#passconf").val();
        if($.trim(pass) === '' ) {$("#passwarn").css('display','block');return false}
        if($.trim(passconf) === '' ) {$("#passconfwarn").css('display','block');return false}
        if($.trim(pass) !== $.trim(passconf)) {$("#passconfwarn").css('display','block');return false}
    });
});




//end processing the form


$(function () {
    $("#name").keydown(function () {
        var VAL = this.value;
        if (/^[A-Za-z][A-Za-z0-9]*$/.test(VAL) || !isNaN(VAL) && e.keyCode !== 9) { $("#namewarn").css('display','block');} else {$("#namewarn").css('display','none');}
    });
});

$(function () {
    $("#family").keydown(function () {
        var VAL = this.value;

        if (/^[A-Za-z][A-Za-z0-9]*$/.test(VAL) || !isNaN(VAL) && e.keyCode !== 9) { $("#familywarn").css('display','block');} else {$("#familywarn").css('display','none');}
    });
});

$(function () {
    $("#familyy").keydown(function () {
        var VAL = this.value;

        if (/^[A-Za-z][A-Za-z0-9]*$/.test(VAL) || !isNaN(VAL) && e.keyCode !== 9) { $("#familywarnn").css('display','block');} else {$("#familywarnn").css('display','none');}
    });
});

$(function () {
    $("#cell").blur(function () {
        var val = this.value.length;
        if(val < 11) {
            $("#cellwarn").css('display','block');
        } else { $("#cellwarn").css('display','none'); }
    });
});

$(function () {
    $("#nac").blur(function () {
        var val = this.value.length;
        if(val < 10) {
            $("#nacwarn").css('display','block');
        } else { $("#nacwarn").css('display','none'); }
    });
});

$(function () {
    $('#bd').datepicker("setDate", new Date(2008,9,03) );
})

// $(function () {
//     $("#bd").blur(function () {
//         var bd = $("#bd").val();
//         var dateReg = /^\d{4}[./-]\d{2}[./-]\d{2}$/;
//         if(!bd.match(dateReg)) {$("#bdwarn").css('display','block');}
//         if(bd.match(dateReg)) {$("#bdwarn").css('display','none');}
//     });
// });

$(function () {
    $("#gen").blur(function () {
        if($('#gen option:selected').prop('disabled') === true) {$("#genwarn").css('display','block');return false}
        if($('#gen option:selected')){$("#genwarn").css('display','none');}
    });
});

$(function () {
    $("#bd").datepicker({
        changeYear:true,
        changeMonth: true,
        dateFormat: 'yy/mm/dd',
        yearRange:'1330:1400',
        defaultDate: '1300/01/01'
    });

});

$(function () {
    $("#start_date").datepicker({
        changeYear:true,
        changeMonth: true,
        dateFormat: 'yy/mm/dd',
        yearRange:'1330:1400',
        defaultDate: '1300/01/01'
    });

});

$(function () {
    $("#end_date").datepicker({
        changeYear:true,
        changeMonth: true,
        dateFormat: 'yy/mm/dd',
        yearRange:'1330:1400',
        defaultDate: '1300/01/01'
    });

});