function submit_contact_form(){
    var fd = new FormData();
    fd.append('ContactSubmit', '1');
    fd.append('name', $("#your_name").val());
    fd.append('email', $("#your_email").val());
    fd.append('phone', $("#phone_number").val());
    fd.append('comments', $("#your_comments").val());
    js_submit(fd,submit_contact_form_callback);
    console.log(fd);
}

function submit_contact_form_callback(data){
    console.log(data);
    var jdata = JSON.parse(data);
    if(jdata.success == 1){
        var mess = jdata.message;
        $("#response_div").html(mess) ;
        $("#response_div").css("padding","20px");
    }else{
        var mess = 'vui lòng kiểm tra lại';
        $("#response_div").html(mess) ;
        $("#response_div").css("padding","20px");
    }
}

function js_submit(fd, callback){
    var submitUrl = 'http://localhost/testplugin/wp-content/plugins/contact-form/process/';
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