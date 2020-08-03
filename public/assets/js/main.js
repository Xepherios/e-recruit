var currentRequest = [];
 
const customSwal = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-info min-width-100',
        cancelButton: 'btn btn-danger min-width-100'
    },
    buttonsStyling: false
});
 

function callAPI( params, callback ) {
    var request_key = btoa(params.request_id);
    currentRequest[request_key] = $.ajax({
        url: params.url, 
        type: params.method, 
        contentType: "application/json; charset=utf-8", 
        dataType: "json",            
        data: JSON.stringify(params.data),
        cache: false,             
        processData: false,
        xhrFields: {
            withCredentials: params.with_credentials
        },
        beforeSend : function(request, setting) {  
            if( params.with_credentials ) {
                request.setRequestHeader("Authorization", "Bearer " + token);
            } 
            if( typeof currentRequest != 'undefined') {
                if(typeof currentRequest[request_key] != 'undefined' && currentRequest[request_key] != null ) {
                    currentRequest[request_key].abort();
                } 
            } 
            currentRequest[request_key] = null;
        },
        success: callback,
        statusCode: {
            400: function(e) {
                var response = e.responseJSON; 
                if(typeof response != 'undefined' && typeof response.error_message != 'undefined' && response.error_message != null){
                    
                    customSwal.fire({ 
                        type: 'error',
                        title: 'มีข้อผิดพลาด',
                        text: response.error_message 
                    });
                } 
            }, 
            401: function(e) {
                var response = e.responseJSON; 
                if(typeof response != 'undefined' && typeof response.error_message != 'undefined' && response.error_message != null){
                    
                    customSwal.fire({ 
                        type: 'error',
                        title: 'ไม่ได้รับอนุญาต',
                        text: response.error_message 
                    });
                } 
            }, 
            403: function(e) {
                var response = e.responseJSON;
            }, 
            404: function(e) {
                var response = e.responseJSON;
            }
        },
        complete: function() {
            currentRequest[request_key] = null;
        },
        error:function(e) { 
            currentRequest[request_key] = null;
        }
    });
}
function showWaitMe(ele, text) {
    $(ele).waitMe({
        effect : 'rotation',
        text : text,
        bg : false,
        color : '#5e72e4',
        maxSize : '',
        waitTime : -1,
        textPos : 'vertical',
        fontSize : '', 
        onClose : function() {}
    });
}
function hideWaitMe(ele) {
    $(ele).waitMe("hide");
}
function renderHandlebarTemplateHtml(place, html, type) {

    switch (type) {
        case 'append':
            $(place).append(html);
            break;
        case 'clear-append':
            $(place).empty();
            $(place).append(html);
            break;
        case 'prepend':
            $(place).empty();
            $(place).prepend(html);
            break;
        case 'replace':
            $(place).replaceWith(html);
            break;
        default:
            $(place).append(html);
            break;
    }
     
}
var label = {
    errors: {
        required: "กรุณาระบุข้อมูลนี้",
        password_do_not_match: "รหัสผ่านไม่ตรงกัน",
        min_password_required:  "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร",
        max_password_required:  "รหัสผ่านต้องไม่เกิน 20 ตัวอักษร",
        invalid_email_format: "รูปแบบอีเมลไม่ถูกต้อง"
    }
};