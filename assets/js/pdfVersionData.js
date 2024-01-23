const base_url = $('#base_url').val();
function ajaxCall(url, data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: base_url + url,
            data: data,
            dataType: 'JSON',
            beforeSend: function () { },
            complete: function () { },
            success: function (data) {
                return resolve(data);
            },
            error: function (e) {
                console.error(e);
            }
        });
    });
}

// tinymce.init({
//     selector: 'textarea#content',
//     readonly: true
// });
CKEDITOR.replace('content');

let resultMap = new Map(), m, rx = /{(.*?)}/g;

let prepareHtml = () => {
    resultMap.clear();
    return new Promise((resolve, reject) => {
        $('#dynamicFields').html('');
        let str1 = CKEDITOR.instances['content'].getData();
        str1 = DOMPurify.sanitize(str1);
        let i = 1;
        while ((m = rx.exec(str1)) !== null) {
            $('#dynamicFields').append('<div class="col-lg-3">' + i + '. {' + m[1] + '}</div>');
            resultMap.set(('{' + m[1] + '}'), ('{' + m[1] + '}'));
            i++;
        }
        return resolve(true);
    });
}

$(document).ready(async () => {
    setTimeout(async () => {
        await getPdfData();
        prepareHtml();
        $('#generatePdf').click();
    }, 1000);

    var editor = CKEDITOR.instances.content;
    if (editor) {
        editor.destroy(true);
    }
    // CKEDITOR.config.readOnly = true;
    CKEDITOR.config.extraPlugins = 'lite';
    var lite = CKEDITOR.config.lite || {};
    CKEDITOR.config.lite = lite;
    CKEDITOR.config.lite.userName = 'Sanjay';
    // CKEDITOR.config.lite.commands = [LITE.Commands.TOGGLE_SHOW, LITE.Commands.ACCEPT_ALL, LITE.Commands.REJECT_ALL];
    CKEDITOR.replace('content', CKEDITOR.config);
});


let generatePDF = () => {
    window.jsPDF = window.jspdf.jsPDF;
    let doc = new jsPDF();
    let newHtml = CKEDITOR.instances['content'].getData();
    newHtml = DOMPurify.sanitize(newHtml);
    $('#showPDF').attr('src', '');
    doc.html(newHtml, {
        callback: function (doc) {
            $('#showPDF').attr('src', doc.output('bloburl'));
        },
        x: 15,
        y: 15,
        width: 170, //target width in the PDF document
        windowWidth: 650 //window width in CSS pixels
    });
}

let preparePdf = async () => {
    await prepareHtml();
    generatePDF();
};

let mapWithMain = async () => {
    let pdfId = $('#pdfId').val();
    let url = 'pdf/updateMainPdf';
    let data = { pdfId: pdfId };
    let ajaxData = await ajaxCall(url, data);
    alert(ajaxData.message);
    if (ajaxData.success == 1) {
        window.location = base_url + 'pdf/versionList/' + ajaxData['pdfId'];
    }
}

let getPdfData = async () => {
    let pdfId = $('#pdfId').val();
    let url = 'pdf/pdfVersionData';
    let data = { pdfId: pdfId };
    let ajaxData = await ajaxCall(url, data);
    if (ajaxData.success == 1) {
        $('#agreement_title').val(ajaxData['data'].agreement_title);
        CKEDITOR.instances['content'].setData(ajaxData['data'].agreement_data);
        if(ajaxData['data'].show_action == 1) {
            $('#copyMain').show();
        }
    }
}