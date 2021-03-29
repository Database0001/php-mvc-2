let cache = {};

function StrToUtf8(str) {
    return str

        .replaceAll("ÃƒÅ“", "Ãœ")
        .replaceAll("ÃƒÂœ", "Ãœ")

        .replaceAll("Ã…", "Å")
        .replaceAll("ÅÂ", "Å")

        .replaceAll("Ã„", "Ä")
        .replaceAll("ÄÂ", "Ä")

        .replaceAll("Ãƒâ€¡", "Ã‡")
        .replaceAll("ÃƒÂ‡", "Ã‡")

        .replaceAll("Ã„Â°", "Ä°")
        .replaceAll("ÄÂ°", "Ä°")

        .replaceAll("Ãƒâ€“", "Ã–")
        .replaceAll("ÃƒÂ–", "Ã–")

        .replaceAll("ÃƒÂ¼", "Ã¼")

        .replaceAll("Ã…Å¸", "ÅŸ")
        .replaceAll("ÅÂŸ", "ÅŸ")

        .replaceAll("Ã„Å¸", "ÄŸ")
        .replaceAll("ÄÂŸ", "ÄŸ")

        .replaceAll("ÃƒÂ§", "Ã§")

        .replaceAll("Ã„Â±", "Ä±")
        .replaceAll("ÄÂ±", "Ä±")

        .replaceAll("ÃƒÂ¶", "Ã¶");
}

function SToA(is) {
    let serialize = $(is).serialize().split('&');
    let arr = {};
    serialize.forEach(function (item) {
        let i = item.split('=');
        arr[i[0]] = StrToUtf8(unescape(i[1]));
    });

    //console.log(arr);

    return arr;
}


$.dos = {
    alert: (status, text, absolute = 0) => {
        let list = $('#notification');
        list.append(`
            <div class="${absolute ? "position-absolute top-1" : ""} mt-2 cursor-pointer" style="z-index: 1; opacity: .9; width: 90%; margin-left: 5%;" onclick="this.remove();">
                <div class="col-12 alert alert-${status}" style="padding: 11px 0px 1px 16px !important; border: none;">
                    <strong>${status}!</strong>
                    <p>
                        ${text}
                    </p>
                </div>
            </div>
        `);

        let last = $([...list.children()].pop());

        last.fadeOut(3000, function () {
            this.remove();
        });

    },
    redirect: (url = "/", timeSec = 0) => {
        setTimeout(() => {
            location.href = url;
        }, (timeSec * 1000));
    },

    btnSpin: function (is) {
        let that = $(is);
        if (that.attr('dont-spin') == undefined) {
            that.attr('disabled', 'disabled');
            that.prepend(`<spinner><i class="fas fa-circle-notch fa-spin p-1"></i></spinner>`);
        }
    },

    btnUnSpin: function (is, timeSec = 0) {
        let that = $(is);
        setTimeout(function () {
            that.find('spinner').remove();
            that.removeAttr('disabled');
        }, (timeSec * 1000));
    },

    freeze: function (is) {
        let that = $(is);
        that.attr('disabled', 'disabled');
    }
};


const error_callback = (xhr) => {
    let errors = xhr.responseJSON.errors;
    let code = xhr.status;

    errors.forEach(function (item, index) {
        $.dos.alert('danger', item);
    });

    // for (let index of Object.keys(errors)) {
    //     let item = errors[index];


    // }

};

const callbacks = {
    auth: (is, e) => {
        let me = $(is);
        if (e.response) {
            $.dos.redirect();
        } else {
            $.dos.alert("danger", e.message);
        }
    }
};


$.ajaxSetup({
    error: function (xhr) {
        return error_callback(xhr);
    }
});


$('[request-form]').on('submit', function (e) {
    e.preventDefault();

    let me = $(this);

    let datas = {
        method: me.attr('method') ? me.attr('method') : "GET",
        action: me.attr('action') ? me.attr('action') : document.URL
    };

    let btn = me.find('[type="submit"]');
    $.dos.btnSpin(btn);

    $.ajax({
        type: datas['method'],
        url: datas['action'],
        data: SToA(this),
        success: function (e) {
            $.dos.btnUnSpin(btn);
            return callbacks[me.attr('request-form')](this, e);
        },
        error: function (xhr) {
            $.dos.btnUnSpin(btn);
            return error_callback(xhr);
        }
    });

});