var dob_picker;
var current_page = 1;
$(document).ready(function() {  
    setHelper();
    getJobs();
    $('input[name="keyword"]').on('keyup', function() {
        getJobs();
    });
    $('select[name="department_id"]').on('change', function() {
        getJobs();
    });
});


function getJobs(page) {
    if( typeof page == 'undefined' || page == null || page <= 0) {
        current_page = current_page;
    } else {
        current_page = page;
    } 
    var keyword = $('input[name="keyword"]').val();
    var department_id = $('select[name="department_id"]').val();
    if( typeof keyword != 'undefined' && keyword != null && keyword != '' && keyword.length > 0 && keyword.length < 3 ) {
        return;
    }
    showWaitMe($("#jobs_list"), "โปรดรอสักครู่");
 
    var condition = "";
    
    if( typeof keyword != 'undefined' && keyword != null && keyword != '' ) {
        condition += "&keyword=" + keyword;
    }
    
    if( typeof department_id != 'undefined' && department_id != null && department_id != '' && department_id > 0 ) {
        condition += "&department_id=" + department_id;
    }
    callAPI(
        {
            request_id: "jobs",  
            url: _config.server_url + "/jobs?page=" + current_page + condition,
            method: "GET"
        },
        function(json) {
            if(json.error_code == 0) {
                if( typeof json.jobs != 'undefined') {
                    var obj_data = {
                        jobs: json.jobs.data 
                    }  
                    var select_source = $("#jobs_list_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#jobs_list");
                    renderHandlebarTemplateHtml(place, html, 'clear-append');
                    
                    current_page = json.jobs.current_page;
                    var last_page = json.jobs.last_page;
                    var previous_page = current_page - 1;
                    if( previous_page <= 0 ) {
                        previous_page = null;
                    }
                    var next_page = current_page + 1;
                    if( next_page > last_page ) {
                        next_page = null;
                    } 
                    
                    var obj_data = {
                        last_page: last_page,
                        previous_page: previous_page,
                        next_page: next_page
                    }  
                    var select_source = $("#jobs_pagination_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#jobs_list_pagination");
                    renderHandlebarTemplateHtml(place, html, 'clear-append');
                    bindPagination();
                } 
            } 
            hideWaitMe($("#jobs_list"));
        }
    );
}

function setHelper() {
     
    Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {

        switch (operator) {
            case '==':
                return (v1 == v2) ? options.fn(this) : options.inverse(this);
            case '===':
                return (v1 === v2) ? options.fn(this) : options.inverse(this);
            case '!=':
                return (v1 != v2) ? options.fn(this) : options.inverse(this);
            case '!==':
                return (v1 !== v2) ? options.fn(this) : options.inverse(this);
            case '<':
                return (v1 < v2) ? options.fn(this) : options.inverse(this);
            case '<=':
                return (v1 <= v2) ? options.fn(this) : options.inverse(this);
            case '>':
                return (v1 > v2) ? options.fn(this) : options.inverse(this);
            case '>=':
                return (v1 >= v2) ? options.fn(this) : options.inverse(this);
            case '&&':
                return (v1 && v2) ? options.fn(this) : options.inverse(this);
            case '||':
                return (v1 || v2) ? options.fn(this) : options.inverse(this);
            default:
                return options.inverse(this);
        }
    });
    Handlebars.registerHelper('listPagination', function(item, options) {
        var out = '';   
        for(var i = 1; i <= item; i++) {
            var class_active = '';
            if( i == current_page ) {
                class_active = ' active ';
            } 
            out = out + '<li class="page-item '+class_active+'"><a class="page-link" data-page="'+i+'">' + i + '</a></li>';
        } 
        return new Handlebars.SafeString( out );
    });
      
}
  
function bindPagination() {
    $('a[data-page]').off('click');
    $('a[data-page]').on('click', function() {
        current_page = $(this).attr('data-page');
        getJobs(current_page);
    });
}