const base_url = $('#base_url').val();
function ajaxCall(url, data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: base_url + url,
            data: data,
            dataType: 'JSON',
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                return resolve(data);
            },
            error: function (e) {
                console.error(e);
            }
        });
    });
}

let login = async () => {
    let email = $('#email').val();
    if(email.trim() == '') {
        alert('Please enter email');
        return;
    }
    let password = $('#password').val();
    if(password.trim() == '') {
        alert('Please enter password');
        return;
    }

    let url = 'login';
    let data = { email : email, password : password };
    let ajaxData = await ajaxCall(url, data);
    if(ajaxData.success == 1) {
        window.location = ajaxData.data['dashboard_page'];
    } else {
        alert(ajaxData.message);
    }
}

let register = async () => {
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
    if(ajaxData.page_url != undefined) {
        window.location = ajaxData.page_url;
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