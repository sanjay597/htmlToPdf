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

$(document).ready(function () {
    getUsers();
});

let getUsers = async () => {
    let url = 'getUsers';
    let data = {};
    let ajaxData = await ajaxCall(url, data);
    if (ajaxData.success == 1) {
        let tbodyData = ``;
        let k = 1;
        for (let i = 0; i < ajaxData.data.length; i++) {
            let userData = ajaxData.data[i];
            let deleteUserBtn = ``;
            let actionUserBtn = ``;
            let editUserBtn = ``;
            if (userData.status != 2) {
                editUserBtn = ajaxData.can_edit ? `<input type="button" class="btn btn-info" value="Edit" onclick="editUser(` + userData.id + `)"/> | ` : '';
                deleteUserBtn = ajaxData.can_delete ? `<input type="button" class="btn btn-` + (userData.status == 1 ? 'danger' : 'success') + `" value="` + (userData.status == 1 ? 'Inactive' : 'Active') + `" onclick="deleteUser(` + userData.id + ',' + userData.status + `)"/>` : '';
            } else {
                actionUserBtn = `<input type="button" class="btn btn-success" value="Approve" onclick="actionUser(` + userData.id + ',' + 1 + `)"/> | <input type="button" class="btn btn-danger" value="Reject" onclick="actionUser(` + userData.id + ',' + 3 + `)"/>`;
            }
            tbodyData += `<tr>`;
            tbodyData += `<td>` + k + `</td>`;
            tbodyData += `<td>` + userData.name + `</td>`;
            tbodyData += `<td>` + userData.mobile + `</td>`;
            tbodyData += `<td>` + userData.email + `</td>`;
            tbodyData += `<td>` + userData.address + `</td>`;
            tbodyData += `<td>` + userData.gender + `</td>`;
            tbodyData += `<td>` + userData.dob + `</td>`;
            tbodyData += `<td>` + (userData.status == 1 ? 'Active' : (userData.status == 2 ? 'Pending' : 'Inactive')) + `</td>`;
            tbodyData += `<td>` + editUserBtn + deleteUserBtn + actionUserBtn + `</td>`;
            k++;
        }
        $('#users_data').html(tbodyData);
    }
}

let addUser = async () => {
    let name = $('#name').val();
    if (name.trim() == '') {
        alert('Please enter name');
        return;
    }
    let mobile = $('#mobile').val();
    if (mobile.trim() == '') {
        alert('Please enter mobile number');
        return;
    }
    let email = $('#email').val();
    if (email.trim() == '') {
        alert('Please enter email');
        return;
    }
    let address = $('#address').val();
    if (address.trim() == '') {
        alert('Please enter address');
        return;
    }
    let gender = $('#gender').val();
    if (gender.trim() == '') {
        alert('Please enter gender');
        return;
    }
    let dob = $('#dob').val();
    if (dob.trim() == '') {
        alert('Please enter dob');
        return;
    }
    let profile_pic = document.querySelector('#profile_pic').files[0];
    if (profile_pic == undefined) {
        alert('Please upload profile pic');
        return;
    }
    let signature = document.querySelector('#signature').files[0];
    if (signature == undefined) {
        alert('Please upload signature');
        return;
    }
    profile_pic_baseimg = await getBase64(profile_pic);
    signature_baseimg = await getBase64(signature);

    let url = 'addUser';
    let data = { name: name, mobile: mobile, email: email, address: address, gender: gender, dob: dob, profile_pic: profile_pic_baseimg, signature: signature_baseimg };
    let ajaxData = await ajaxCall(url, data);
    alert(ajaxData.message);
    if (ajaxData.page_url != undefined) {
        window.location = base_url + ajaxData.page_url;
    }
}

function getBase64(file) {
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            return resolve(reader.result);
        };
        reader.onerror = function (error) {
            return reject('Error: ', error);
        };
    });
}

function editUser(id) {
    window.location = base_url + 'editUser/' + id;
}

let deleteUser = async (id, status) => {
    if (confirm('Are you sure, you want to ' + (status == 1 ? ' inactive ' : ' active ') + ' this user?')) {
        let url = 'deleteUser';
        let data = { id: id };
        let ajaxData = await ajaxCall(url, data);
        getUsers();
        alert(ajaxData.message);
    }
}

let actionUser = async (id, status) => {
    if (confirm('Are you sure, you want to ' + (status == 1 ? ' approve ' : ' reject ') + ' this user?')) {
        let url = 'actionUser';
        let data = { id: id, status: status };
        let ajaxData = await ajaxCall(url, data);
        getUsers();
        alert(ajaxData.message);
    }
}

let updateUser = async () => {
    let userId = $('#userId').val();
    let name = $('#name').val();
    if (name.trim() == '') {
        alert('Please enter name');
        return;
    }
    let mobile = $('#mobile').val();
    if (mobile.trim() == '') {
        alert('Please enter mobile number');
        return;
    }
    let email = $('#email').val();
    if (email.trim() == '') {
        alert('Please enter email');
        return;
    }
    let address = $('#address').val();
    if (address.trim() == '') {
        alert('Please enter address');
        return;
    }
    let gender = $('#gender').val();
    if (gender.trim() == '') {
        alert('Please enter gender');
        return;
    }
    let dob = $('#dob').val();
    if (dob.trim() == '') {
        alert('Please enter dob');
        return;
    }
    let profile_pic_baseimg = '';
    let profile_pic = document.querySelector('#profile_pic').files[0];
    let old_pic = $('#old_pic').val();
    if (profile_pic != undefined) {
        profile_pic_baseimg = await getBase64(profile_pic);
    }
    let signature_baseimg = '';
    let signature = document.querySelector('#signature').files[0];
    let old_sign = $('#old_sign').val();
    if (signature != undefined) {
        signature_baseimg = await getBase64(signature);
    }

    let url = 'addUser';
    let data = { name: name, mobile: mobile, email: email, address: address, gender: gender, dob: dob, profile_pic: profile_pic_baseimg, signature: signature_baseimg, old_pic: old_pic, old_sign: old_sign, userId: userId };
    let ajaxData = await ajaxCall(url, data);
    alert(ajaxData.message);
    if (ajaxData.page_url != undefined) {
        window.location = base_url + ajaxData.page_url;
    }
}