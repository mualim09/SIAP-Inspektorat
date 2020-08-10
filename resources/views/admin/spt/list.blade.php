  
<div class="tab-pane show active" id="list-spt">  
    <div class="row">
        <div class="col-md-10"><h2 class="text-center">{{ __('Data SPT') }}</h2></div>
        <div class="col">           
                @can('Create SPT')
                <div class="mb-2 mb-md-0">                    
                    <button id="btn-new-spt" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formModal">{{ __('Tambah SPT') }}</button>
                </div>    
                @endcan
        </div>
    </div>
    
    
    @include('admin.spt.form')
    
    <div class="table-responsive">
        <table class="table table-striped table-sm ajax-table" id="list-spt-table">
            <thead>
            
            </thead>
            <tbody></tbody>
          
        </table>
    </div>
</div>