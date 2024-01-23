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
//     //use the setup option to handle events taking place within TinyMCE. Handling an event that returns data – in this case, an alert
//     // setup: function (editor) {
//     //     editor.on('click', function (e) { //Thanks to Benson Kariuki for the keydown event code https://www.section.io/engineering-education/keyboard-events-in-javascript/#javascript-keyboard-events
//     //         myCustomOnChangeHandler();
//     //     })
//     // }
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

$(document).ready(async() => {
    setTimeout(() => {
        prepareHtml();
        $('#generatePdf').click();
    }, 3000);
});

let exportExcelData = () => {
    let exportData = [];
    let excelHeaders = [...resultMap.values()];
    for (let i in excelHeaders) {
        let temp = {};
        temp[excelHeaders[i]] = '';
        exportData.push(temp);
    }
    let ws = XLSX.utils.json_to_sheet(exportData);
    let wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "People");
    XLSX.writeFile(wb, "reports.xlsx");
}


let generatePDF = () => {
    console.log('here');
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

let savePdfData = async () => {
    let agreement_title = $('#agreement_title').val();
    if(agreement_title.trim() == '') {
        alert('Please enter agreement title');
        return;
    }
    let agreement = CKEDITOR.instances['content'].getData();
    if(agreement.trim() == '') {
        alert('Please enter agreement content');
        return;
    }
    let url = 'pdf/saveData';
    let data = {agreement_title:agreement_title, agreement:agreement};
    let ajaxData = await ajaxCall(url, data);
    alert(ajaxData.message);
    window.location = base_url + 'admin/pdfList';
}