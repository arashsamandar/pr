function get_info_o(value, type) {
    $.ajax({
        type: "POST",
        cache: false,
        url: "engine.php?action=get_info_o",
        data: {
            value: value,
            type: type
        },
        success: function(html) {
        }
    });
}

function number_format(input){
    var num = ""+input.replace(/[^\d]/g,'');
    if(num.length>3) {
        num = num.replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    }
    $("#thecost").val(num);
    return num;
}

function cost_veiw(value, type) {
    $.ajax({
        type: "POST",
        cache: false,
        url: "engine.php?action=cost_veiw",
        data: {
            value: value,
            type: type
        },
        success: function(html) {
        }
    });
}
function find_state(value, type) {
    v = $("#" + value).val();
    $.ajax({
        type: "POST",
        cache: false,
        url: "engine.php?action=find_state",
        data: {
            value: v,
            type: type
        },
        success: function(html) {
        }
    });
}
function auto_complete(value, type) {
    $("."+type).fadeIn();
    $.ajax({
        type: "POST",
        cache: false,
        url: "engine.php?action=autoComplete",
        data: {
            value: value,
            type: type
        },
        success: function(html) {
            $("body").append(html);
        }
    });
}
function search_f(value, type) {
    $("."+type).fadeIn();
    $.ajax({
        type: "POST",
        cache: false,
        url: "engine.php?action=search_f",
        data: {
            value: value,
            type: type
        },
        success: function(html) {
            $("body").append(html);
        }
    });
}
function fill_input(element) {
    input_value = $(element).html();
    class_name = $(element).parent().attr("class").split(' ')[1];
    $("#"+class_name).val(input_value);
    $("."+class_name).hide();
}