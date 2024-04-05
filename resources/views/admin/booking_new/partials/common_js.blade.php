$(".application_date").datetimepicker({
    ignoreReadonly: true,
    format: 'YYYY-MM-DD'
});

$(".application_time").datetimepicker({
    ignoreReadonly: true,
    format: 'LT'
});

$(".adv_amount_date").datetimepicker({
    ignoreReadonly: true,
    format: 'YYYY-MM-DD'
});

function getLeadDetails(text, projectId) {
    $.ajax({
        method: "GET",
        url: "{{ route('admin.eoi.lead.detail') }}",
        data: {
            search_term: text,
            project_id: projectId  // Add project_id to the request data
        },
        dataType: "json",
        success: function (response) {
            if (response.success) {
                $(".sell_do_and_lead_info").html(response.html);
            } else {
                alert(response.msg);
                if (response.redirect_url) {
                    setTimeout(() => {
                        window.location.replace(response.redirect_url);
                    }, 100);
                }
            }
            toggleInfoSection();
        }
    });
}


$(document).on('click', ".search_lead", function() {
    let text = $("#search_phone").val();
    let projectId = $("#project_id").val();
    if(text.length < 10) {
        alert('Enter 10 digit valid number');
        return;
    }
    getLeadDetails(text,projectId);
});

function togglePlanHomeConstructionDiv() {
    if($("#is_planning_to_construct_home").val() == 'Yes') {
        $("#Planning_to_Construct_Home").closest('div').find('label').addClass('required');
        $("#Planning_to_Construct_Home").attr('required', true);
        $("#Planning_to_Construct_Home").parent().parent().show();
    } else {
        $("#Planning_to_Construct_Home").closest('div').find('label').removeClass('required');
        $("#Planning_to_Construct_Home").attr('required', false);
        $("#Planning_to_Construct_Home").val('');
        $("#Planning_to_Construct_Home").parent().parent().hide();
    }
}

$(document).on('change', '#is_planning_to_construct_home', function(){
    togglePlanHomeConstructionDiv();
});

function toggleFinancingPlanDiv() {
    if($("#Financing_Plan_interested_in_loan").val() == 'Yes') {
        $(".Financing_Plan_div").each(function(){
            $(this).find('label').addClass('required');
            $(this).find('input').attr('required', true);
        });
        $(".Financing_Plan_div").show();
    } else {
        $(".Financing_Plan_div").each(function(){
            $(this).find('label').removeClass('required');
            $(this).find('input').attr('required', false);
            $(this).find('input').val('');
        });
        $(".Financing_Plan_div").hide();
    }
}

$(document).on('change', '#Financing_Plan_interested_in_loan', function(){
    toggleFinancingPlanDiv();
});

function toggleLoanInterestedDiv() {
    if($("#interested_in_loan").val() == 'Yes') {
        $(".loan_div").each(function(){
            $(this).find('label').addClass('required');
            $(this).find('input').attr('required', true)
        });
        $(".loan_div").show();
    } else {
        $(".loan_div").each(function(){
            $(this).find('label').removeClass('required');
            $(this).find('input').attr('required', false);
            $(this).find('input').val('');
        });
        $(".loan_div").hide();
    }
}

$(document).on('change', '#interested_in_loan', function(){
    toggleLoanInterestedDiv();
});

$(document).on('change', '#lead_details_residential_status', function() {
    let status = $(this).val();
    if(status && (status == 'Resident' || status == 'NRI')) {
        $('#lead_details_Correspondence_Address').attr('required', true);
        $("#lead_details_Correspondence_Address").closest('div').find('label').addClass('required');
    } else {
        $('#lead_details_Correspondence_Address').attr('required', false);
        $("#lead_details_Correspondence_Address").closest('div').find('label').removeClass('required');
    }
});

$(document).on('change', '#details_of_co_applicant_residential_status', function() {
    let status = $(this).val();
    if(status && (status == 'Resident' || status == 'NRI')) {
        $('#details_of_co_applicant_Correspondence_Address').attr('required', true);
        $("#details_of_co_applicant_Correspondence_Address").closest('div').find('label').addClass('required');
    } else {
        $('#details_of_co_applicant_Correspondence_Address').attr('required', false);
        $("#details_of_co_applicant_Correspondence_Address").closest('div').find('label').removeClass('required');
    }
});

togglePlanHomeConstructionDiv();
toggleFinancingPlanDiv();
toggleLoanInterestedDiv();

@if(!empty($phone))
    let text = $("#search_phone").val();
    getLeadDetails(text);
@endif

function toggleInfoSection() {
    if($("#lead_id").val()) {
        $(".info_section").show();
        $("button").show();
    } else{
        $(".info_section").hide();
        $("button").hide();
    }
}

toggleInfoSection();

$("#eoi").validate();
