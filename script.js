function brandCheck(param) {
    let value = (param.value);
    let [model_select, model_select_children, title_select] = (param.id === "brand_one") ? [$("#model_one"), $("#model_one *"), $("#title_one")] : [$("#model_two"), $("#model_two *"), $("#title_two")];
    if (title_select.css("visibility") === "visible") {
        title_select.css("visibility", "hidden");
        $(".btn-submit").css("visibility", "hidden");
    }
    if (value == "" || title_select.css("visibility") === "visible") {
        model_select.css("visibility", "hidden");
        title_select.css("visibility", "hidden");
        $(".btn-submit").css("visibility", "hidden");
    } else {
        $.ajax({
            type: "GET",
            url: "get_models.php",
            data: "make=" + value,
            dataType: "json"
        })
            .done(function (result) {
                model_select_children.remove();
                model_select.append("<option value=''>Choose Model</option>");
                for (key in result) {
                    model_select.append("<option value='" + result[key] + "'>" + result[key] + "</option>");
                    model_select.css("visibility", "visible");
                }
            });
    }
}

function modelCheck(param) {
    let value = (param.value);
    let [title_select, title_select_children, not_selected] = (param.id === "model_one") ? [$("#title_one"), $("#title_one *"), $("#title_two")] : [$("#title_two"), $("#title_two *"), $("#title_one *")];
    if (value == "") {
        title_select.css("visibility", "hidden");
        $(".btn-submit").css("visibility", "hidden");
    }
    $.ajax({
        type: "GET",
        url: "get_titles.php",
        data: "model=" + value,
        dataType: "json",
        success: function (result) {
            title_select_children.remove();
            for (key in result) {
                title_select.append("<option value='" + result[key] + "'>" + result[key] + "</option>");
            }
            if (result.length != 0) { title_select.css("visibility", "visible"); }
            if (title_select.css("visibility") !== "hidden" && $("form.hidden").css("display") === "none") {
                $(".btn-submit").css("visibility", "visible");
            }else if($("form.hidden").css("display") !== "none" && (title_select.css("visibility") !== "hidden" && not_selected.css("visibility") !== "hidden")){
                $(".btn-submit").css("visibility", "visible");
            }
        }
    })



}


$(document).ready(function () {

    $(".btn-add-car").hover(function () {
        if ($(".plus").hasClass("exit")) {
            $(".plus").addClass("rotated-exit");
            $(this).css("border-color", "#c3073f");
            $(this).addClass("expanded-exit");
            $(this).append("<span id='added-car-text'>Remove car</span>");
        } else {
            $(".plus").addClass("rotated");
            $(this).css("border-color", "#5cdb95");
            $(this).append("<span id='added-car-text'>Add car for comparison</span>");
            $(this).addClass("expanded");
        }
        setTimeout(function () {
            $("#added-car-text").css("display", "block");
        }, 500);
    }, function () {
        $(".plus").removeClass("rotated rotated-exit");
        $(this).removeClass("expanded expanded-exit");
        $(this).css("border-color", "#b8b8b9");
        $("#added-car-text").remove();
    });

    $(".btn-add-car").click(function () {
        if ($("form.hidden").css("display") == "none") {
            $("form.hidden").css({ "display": "flex", "justify-content": "center", "flex-direction": "column" });
            $(".separator").css("display", "block");
            if ($("#title_two").css("visibility") === "hidden") {
                $(".btn-submit").css("visibility", "hidden");
            }
        } else {
            $("form.hidden").css("display", "none");
            $(".separator").css("display", "none");
            if ($("#title_one").css("visibility") !== "hidden") {
                $(".btn-submit").css("visibility", "visible");
            }
        }
        $(".plus").toggleClass("exit");

    });

    $("#brand_one").change(function () {
        brandCheck(this);
    });

    $("#brand_two").change(function () {
        brandCheck(this);
    });

    $("#model_one").change(function () {
        modelCheck(this);
    });

    $("#model_two").change(function () {
        modelCheck(this);
    });

    $(".btn-submit").click(function () {
        let model_one = $("#model_one").val();
        let title_one = $("#title_one").val();
        let [model_two, title_two] = ($("form.hidden").css("display") == "none") ? ["", ""] : [$("#model_two").val(), $("#title_two").val()];
        $.ajax({
            type: "POST",
            url: "get_details.php",
            data: { "model_one": model_one, "title_one": title_one, "model_two": model_two, "title_two": title_two }
        })
            .done(function (result) {
                localStorage.setItem("hide_the_cards", result);
                window.location.href = "details.php";
            });
    });

    var what = localStorage.getItem("hide_the_cards");
    if (what === "true") {
        $("#hideme").addClass("hidden-cards");
        localStorage.clear();
    } else {
        $("#hideme").removeClass("hidden-cards");
        localStorage.clear();
    }

});