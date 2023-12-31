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

$(document).ready(() => {
    listData();
});

let listData = async () => {
    $('#searchTable').dataTable().fnDestroy();
    let url = 'pdf/listData';
    let data = {};
    let ajaxData = await ajaxCall(url, data);
    let tbodyData = ``;
    let k = 1;
    if (ajaxData.success == 1) {
        for (let i = 0; i < ajaxData['data'].length; i++) {
            let ajData = ajaxData['data'][i];
            let action = ajData['show_action'] == 1 ? (ajData['status'] == 1 ? '<input type="button" value="Inactive" class="btn btn-danger" onclick="updatePdfStatus(' + ajData["status"] + ', ' + ajData["id"] + ');"/>' : '<input type="button" value="Active" class="btn btn-success" onclick="updatePdfStatus(' + ajData["status"] + ', ' + ajData["id"] + ');"/>') : '';
            let final_submit = ajData['show_action'] == 1 && ajData['final_status'] == 2 && ajData['status'] == 1 ? '<input type="button" value="Submit" class="btn btn-info" onclick="finalSubmit(' + ajData["id"] + ');"/>' : '';
            tbodyData += `<tr><td>` + k + `</td>`;
            tbodyData += `<td><a href="` + (base_url + 'pdf/viewPdf' + '/' + ajData['id']) + `">` + ajData['agreement_title'] + `</a></td>`;
            tbodyData += `<td>` + ajData['name'] + `</td>`;
            tbodyData += `<td>` + ajData['total_versions'] + ` - <a href="` + (base_url + 'pdf/versionList' + '/' + ajData['id']) + `">View</a></td>`;
            tbodyData += `<td>` + ajData['created_date'] + `</td>`;
            tbodyData += `<td>` + final_submit + `</td>`;
            tbodyData += `<td>` + action + `</td></tr>`;
            k++;
        }
    }
    $('#search_table_data').html(tbodyData);
    $('#searchTable').DataTable(
        {
            "paging": true,
            "autoWidth": true,
            "bPaginate": true,
            "bLengthChange": true,
            "responsive": true,
            "bDestroy": true
        }
    );
}

let updatePdfStatus = async (status, id) => {
    status = status == 1 ? 0 : 1;
    let url = 'pdf/updatePdfStatus';
    let data = { status, id };
    let ajaxData = await ajaxCall(url, data);
    alert(ajaxData.message);
    if (ajaxData.success == 1) {
        listData();
    }
}

let finalSubmit = async (id) => {
    let url = 'pdf/updatePdfFinalStatus';
    let data = { id };
    let ajaxData = await ajaxCall(url, data);
    alert(ajaxData.message);
    if (ajaxData.success == 1) {
        listData();
    }
}