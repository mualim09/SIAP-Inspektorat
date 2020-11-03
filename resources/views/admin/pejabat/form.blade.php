<form id="satgas-ppm" class="ajax-form needs-validation" novalidate>
@csrf
    <!-- inspektur -->
    <div class="form-group row">
        <label for="inspektur" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur') }}</label>
        <div class="col-md-4">
            <select class="form-control selectize" id="inspektur" name="inspektur">
                <option value="">{{ __('Pilih Pejabat') }}</option>
                @foreach($users as $user)
                <?php
                    $selected_inspektur = (!is_null($inspektur['user']) && $user->id == $inspektur['user']->id) ? 'selected' : '';                                    
                ?>
                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_inspektur }} >{{ $user->full_name_gelar }}</option>                               
                @endforeach
            </select>                            
        </div>
        @if($inspektur['is_plt'] === true)
            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
        @endif                        
    </div>

    <!-- sekretaris -->
    <div class="form-group row">
        <label for="sekretaris" class="col-md-2 col-form-label text-md-right">{{ __('Sekretaris') }}</label>
        <div class="col-md-4">
            <select class="form-control selectize" id="sekretaris" name="sekretaris">
                <option value="">{{ __('Pilih Pejabat') }}</option>
                @foreach($users as $user)
                <?php
                    $selected_sekretaris = (!is_null($sekretaris['user']) && $user->id == $sekretaris['user']->id) ? 'selected' : '';                                    
                ?>
                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_sekretaris }} >{{ $user->full_name_gelar }}</option>                               
                @endforeach
            </select>                            
        </div>
        @if($sekretaris['is_plt'] === true)
            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
        @endif
    </div>

    <!-- irban 1 -->
    <div class="form-group row">
        <label for="irban_i" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah I') }}</label>
        <div class="col-md-4">
            <select class="form-control selectize" id="irban-i" name="irban_i">
                <option value="">{{ __('Pilih Pejabat') }}</option>
                @foreach($users as $user)
                <?php
                    $selected_irban_i = (!is_null($irban_i['user']) && $user->id == $irban_i['user']->id) ? 'selected' : '';
                ?>
                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_i }} >{{ $user->full_name_gelar }}</option>
                @endforeach
            </select>
        </div>
        @if($irban_i['is_plt'] === true)
            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
        @endif
    </div>

    <!-- irban 2 -->
    <div class="form-group row">
        <label for="irban_ii" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah II') }}</label>
        <div class="col-md-4">
            <select class="form-control selectize" id="irban-ii" name="irban_ii">
                <option value="">{{ __('Pilih Pejabat') }}</option>
                @foreach($users as $user)
                <?php
                    $selected_irban_ii = (!is_null($irban_ii['user']) && $user->id == $irban_ii['user']->id) ? 'selected' : '';
                ?>
                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_ii }} >{{ $user->full_name_gelar }}</option>
                @endforeach
            </select>
        </div>
         @if($irban_ii['is_plt'] === true)
            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
        @endif
    </div>

    <!-- irban 3 -->
    <div class="form-group row">
        <label for="irban_iii" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah III') }}</label>
        <div class="col-md-4">
            <select class="form-control selectize" id="irban-iii" name="irban_iii">
                <option value="">{{ __('Pilih Pejabat') }}</option>
                @foreach($users as $user)
                <?php
                    $selected_irban_iii = (!is_null($irban_iii['user']) && $user->id == $irban_iii['user']->id) ? 'selected' : '';
                ?>
                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_iii }} >{{ $user->full_name_gelar }}</option>
                @endforeach
            </select>
        </div>
        @if($irban_iii['is_plt'] === true)
            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
        @endif
    </div>

    <!-- irban 4 -->
    <div class="form-group row">
        <label for="irban_iv" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah IV') }}</label>
        <div class="col-md-4">
            <select class="form-control selectize" id="irban-iv" name="irban_iv">
                <option value="">{{ __('Pilih Pejabat') }}</option>
                @foreach($users as $user)
                <?php
                    $selected_irban_iv = (!is_null($irban_iv['user']) && $user->id == $irban_iv['user']->id) ? 'selected' : '';
                ?>
                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_iv }}>{{ $user->full_name_gelar }}</option>
                @endforeach
            </select>
        </div>
        @if($irban_iv['is_plt'] === true)
            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
        @endif
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary float-right" id="submit-pejabat">{{ __('Simpan') }}</button>
        </div>                        
    </div>
   
</form>

<script type="text/javascript">
  $('#inspektur').selectize({
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Pilih Pejabat',
   create: false
  });

  $('#sekretaris').selectize({
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Pilih Pejabat',
   create: false
  });

  $('#irban-i').selectize({
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Pilih Pejabat',
   create: false
  });

  $('#irban-ii').selectize({
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Pilih Pejabat',
   create: false
  });

  $('#irban-iii').selectize({
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Pilih Pejabat',
   create: false
  });

  $('#irban-iv').selectize({
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Pilih Pejabat',
   create: false
  });

  

    //form submit
    $("#satgas-ppm").validate({

        submitHandler: function(form){
            
            var inspektur = $('select[name=inspektur] option').filter(':selected').val();
            var sekretaris = $('select[name=sekretaris] option').filter(':selected').val();
            var irban_i = $('select[name=irban_i] option').filter(':selected').val();
            var irban_ii = $('select[name=irban_ii] option').filter(':selected').val();
            var irban_iii = $('select[name=irban_iii] option').filter(':selected').val();
            var irban_iv = $('select[name=irban_iv] option').filter(':selected').val();
            // alert(inspektur+'<br/>'+sekretaris+'<br/>'+irban_i+'<br/>'+irban_ii+'<br/>'+irban_iii+'<br/>'+irban_iv+'<br/>');

            url = "{{ route('submit_pejabat') }}"

            $.ajax({
                url: url,
                type: "POST",
                data: $('.ajax-form').serialize(),
                success: function($data){
                    $('.ajax-form')[0].reset();
                    location.reload();
                },
                error: function($data){
                }
            });
        }
    });
</script>