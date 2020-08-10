<div class="col-md-12 role-form">
	<form id="role-form" class="ajax-form needs-validation" novalidate>
		<input type="hidden" name="id" id="id">
        @csrf
		<div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Nama Opd') }}</label>
            <div class="col-md-8">
                <!-- <input id="nama_skpd" type="text" class="form-control @error('nama_skpd') is-invalid @enderror" name="nama_skpd" value="{{ old('nama_skpd') }}" required autocomplete="nama_skpd" autofocus>   -->

                 <select id="nama_skpd" type="text" class="form-control" name="nama_skpd" value="{{ old('nama_skpd') }}" class="form-control" data-toggle="select" data-placeholder="Select a state">
                    <option value="Dinas Pariwisata">Dinas Pariwisata</option>
                    <option value="Dinas Pendidikan">Dinas Pendidikan</option>
                    <option value="Dinas Kominfo">Dinas Kominfo</option>
                    <option value="Dinas Kesehatan">Dinas Kesehatan</option>
                    <option value="Dinas Perhutanan">Dinas Perhutanan</option>
                </select>                 
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Nama Kegiatan') }}</label>
            <div class="col-md-8">
                <input id="nama_kegiatan" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required autocomplete="nama_kegiatan" autofocus>                   

                @error('nama_kegiatan')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Tujuan Kegiatan') }}</label>
            <div class="col-md-8">
                <input id="tujuan_kegiatan" type="text" class="form-control @error('tujuan_kegiatan') is-invalid @enderror" name="tujuan_kegiatan" value="{{ old('tujuan_kegiatan') }}" required autocomplete="tujuan_kegiatan" autofocus>                   

                @error('tujuan_kegiatan')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Tujuan Perangkat Daerah') }}</label>
            <div class="col-md-8">
                <textarea id="tujuan" type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" value="{{ old('tujuan') }}" required autocomplete="tujuan" autofocus></textarea>

                @error('tujuan')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Sasaran Perangkat Daerah') }}</label>
            <div class="col-md-8">
                <textarea id="sasaran" type="text" class="form-control @error('sasaran') is-invalid @enderror" name="sasaran" value="{{ old('sasaran') }}" required autocomplete="sasaran" autofocus></textarea>                  

                @error('sasaran')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Kegiatan yang Mendukung Capaian Sasaran Perangkat Daerah') }}</label>
            <div class="col-md-8">
                <textarea id="sasaran_kegiatan" type="text" class="form-control @error('sasaran_kegiatan') is-invalid @enderror" name="sasaran_kegiatan" value="{{ old('sasaran_kegiatan') }}" required autocomplete="sasaran_kegiatan" autofocus></textarea>                  

                @error('sasaran_kegiatan')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">{{ __('Detail Tujuan Kegiatan') }}</label>
            <div class="col-md-8">
                <input id="detail_tujuan_kegiatan" type="text" class="form-control @error('detail_tujuan_kegiatan') is-invalid @enderror" name="detail_tujuan_kegiatan" value="{{ old('detail_tujuan_kegiatan') }}" required autocomplete="detail_tujuan_kegiatan" autofocus>                  

                @error('detail_tujuan_kegiatan')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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