<div class="col-md-12 role-form">
    <form id="laporan-form" class="ajax-form needs-validation" novalidate>    
        @foreach($spt as $data)
        <input type="hidden" name="id" id="id" value="{{$data->spt->id}}">
        @csrf
        <!-- belum diganti get data -->
        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Nomor SPT') }}</label>
            <div class="col-md-8">
                <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor" value="{{ $data->spt->nomor }}"  autofocus readonly>                   

                @error('nomor')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- belum diganti get data -->
        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Judul SPT') }}</label>
            <div class="col-md-8">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->spt->name }}" autofocus readonly>                   

                @error('name')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @endforeach
        </div>

        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">Upload Temuan</label>
              <div class="col-md-8">
                  <input type="file" class="form-control-file" id="file" value="file">
                  <a>format file : word</a>
              </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary offset-md-3">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>
</div>