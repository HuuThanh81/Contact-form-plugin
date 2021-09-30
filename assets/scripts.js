function Submit(){
    grecaptcha.ready(function() {
        grecaptcha.execute('6LfsYZwcAAAAAPKXoyz-XE1-ikThLTS4tJ1EZw80', {action: 'submit'}).then(function(token) {
            console.log(token);
           submit_contact_form();
        });
      });
}

function submit_contact_form(){
    if($("#your_name").val() != '' && $("#your_name").val().length > 5){
        if ($("#your_email").val() != '' && /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test($("#your_email").val())) {
            if ($("#phone_number").val() != '' && $("#phone_number").val().length == 10) {
                if ($("#your_comments").val() != '') {
                    var fd = new FormData();
                    fd.append('ContactSubmit', '1');
                    fd.append('name', $("#your_name").val());
                    fd.append('email', $("#your_email").val());
                    fd.append('phone', $("#phone_number").val());
                    fd.append('comments', $("#your_comments").val());
                    js_submit(fd,submit_contact_form_callback);
                } else {
                    var mess = "Vui lòng điền nội dung lời nhắn";
                    alert(mess);
                }
            } else {
                var mess = "Vui lòng điền đúng số điện thoại";
                alert(mess);
            }
        } else {
            var mess = "Vui lòng điền đúng email";
            alert(mess);
        }
    }else{
        var mess = "Vui lòng điền họ tên lớn hơn 5 kí tự";
        alert(mess);
    }
}

function submit_contact_form_callback(data){
    var jdata = JSON.parse(data);
    if(jdata.success == 1){
        var mess = jdata.message;
        alert(mess);
    }
}

function js_submit(fd, callback){
    var submitUrl = window.location.href + 'wp-content/plugins/contact-form/process/';
    console.log(submitUrl);
    $.ajax({
        url: submitUrl, 
        type:'post',
        data:fd,
        contentType:false,
        processData:false, 
        success:function(response){
             callback(response);
        }});

}