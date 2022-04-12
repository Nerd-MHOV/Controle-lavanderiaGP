function ajax_load(action) {
    ajax_load_div = $(".ajax_load");

    if (action === "open") {
        ajax_load_div.fadeIn(200).css("display", "flex");
    }

    if (action === "close") {
        ajax_load_div.fadeOut(200);
    }
}

$("form").submit(function (e) {
    e.preventDefault();

    var form = $(this);
    var action = form.attr("action");
    var data = form.serialize();

    $.ajax({
        url: action,
        data: data,
        type: "post",
        dataType: "json",
        beforeSend: function (load) {
            ajax_load("open");
        },
        success: function (su) {
            ajax_load("close");

            if (typeof modal !== "undefined") {
                modal.style.display = "none";

                if (su.message.type === "success") {
                    let id_saida = su.message.id

                    $("[data-id="+id_saida+"]").remove();
                }
            }

            if (su.message) {
                var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                $(".login_form_callback").html(view);
                $(".message").effect("bounce");
                return;
            }

            if (su.redirect) {
                window.location.href = su.redirect.url;
            }
        }
    });


});