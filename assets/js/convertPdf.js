tinymce.init({
    selector: 'textarea#content',
    //use the setup option to handle events taking place within TinyMCE. Handling an event that returns data – in this case, an alert
    // setup: function (editor) {
    //     editor.on('click', function (e) { //Thanks to Benson Kariuki for the keydown event code https://www.section.io/engineering-education/keyboard-events-in-javascript/#javascript-keyboard-events
    //         myCustomOnChangeHandler();
    //     })
    // }
});

let resultMap = new Map(), m, rx = /{(.*?)}/g;

let prepareHtml = () => {
    $('#dynamicFields').html('');
    let str1 = tinymce.get("content").getContent();
    str1 = DOMPurify.sanitize(str1);
    let i = 1;
    while ((m = rx.exec(str1)) !== null) {
        $('#dynamicFields').append('<div class="col-lg-3">' + i + '. {' + m[1] + '}</div>');
        resultMap.set(('{' + m[1] + '}'), ('{' + m[1] + '}'));
        i++;
    }
}

setTimeout(() => {
    prepareHtml();
    generatePDF();
}, 1000);

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
    window.jsPDF = window.jspdf.jsPDF;
    let doc = new jsPDF();
    let newHtml = tinymce.get("content").getContent();
    newHtml = DOMPurify.sanitize(newHtml);
    $('#showPDF').attr('src', '');
    doc.html(newHtml, {
        callback: function (doc) {
            // console.log(doc.output('datauristring'));
            // console.log(doc.output('bloburl'));
            $('#showPDF').attr('src', doc.output('bloburl'));
        },
        x: 15,
        y: 15,
        width: 170, //target width in the PDF document
        windowWidth: 650 //window width in CSS pixels
    });
}

let preparePdf = () => {
    prepareHtml();
    generatePDF();
};