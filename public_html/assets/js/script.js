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

$.ajaxSetup({
    error: function (xhr) {
        //alert("Konsola bak hata var");
        console.log(xhr);
    }
});

const callbacks = {
    signin: (is, e) => {
        let me = $(is);
        if (e.response) {
            location.href = "/";
        } else {
            alert(e.message);
        }
    }
};

$('[request-form]').on('submit', function (e) {
    e.preventDefault();

    let me = $(this);

    let datas = {
        method: me.attr('method') ? me.attr('method') : "GET",
        action: me.attr('action') ? me.attr('action') : document.URL
    };

    $.ajax({
        type: datas['method'],
        url: datas['action'],
        data: SToA(this),
        success: function (e) {
            return callbacks[me.attr('request-form')](this, e);
        }
    });

});