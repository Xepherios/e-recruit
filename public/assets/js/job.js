 
$(document).ready(function() {  
    
    $("#apply_job_btn").on("click", function() {
        applyJob();
    }); 
});

function applyJob() {
    var job_id = $("#job_id").val();
    var data = {
        job_id: job_id
    };
    
    callAPI(
        {
            request_id: "create_application",
            data: data,
            url: "http://e-recruit.me/application",
            method: "POST"
        },
        function(json) {
            $("#apply_job_btn").prop('disabled', true);
            if(json.error_code == 0) {
                customSwal.fire({ 
                    type: 'success',
                    text: 'ส่งใบสมัครเรียบร้อย', 
                });
            } else {
                $("#apply_job_btn").prop('disabled', false);
            }
 
        }
    );
}