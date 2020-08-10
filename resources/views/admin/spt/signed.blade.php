<div class="tab-pane" id="signed-spt">
    <h3 class="text-center">{{ __('Signed SPT') }}</h3>    
    @include('admin.spt.form')
    <div class="table-responsive">
        <table class="table table-striped table-sm ajax-table" id="roles-table">
            <thead>
            <tr>
                <th></th>
                <th>{{ __('Nama') }}</th>
                <th>{{ __('Dasar') }}</th>
                <th>{{ __('Isi') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
            </thead>
            <tbody></tbody>
          
        </table>
    </div>
</div>