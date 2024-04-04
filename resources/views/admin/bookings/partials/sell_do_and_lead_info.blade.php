<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                Sell.do details
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                @includeIf('admin.bookings.partials.sell_do_detail')
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                @lang('messages.basic_details_of_applicant')
            </h3>
        </div>
        <div class="card-body">
            <div class="row basic_common_details_of_applicant">
                @includeIf('admin.bookings.partials.basic_details_of_applicant')
            </div>
        </div>
    </div>
</div>
