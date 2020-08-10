<form id="resiko-form" class="ajax-form needs-validation" novalidate>
          <input type="hidden" name="id" id="id">
              @csrf
          <div class="form-group row">
                  <label class="col-md-2 col-form-label text-md-right">{{ __('Nama Perangkat Daerah') }}</label>
                  <div class="col-md-8">
                      <!-- <input id="nama_skpd" type="text" class="form-control @error('nama_skpd') is-invalid @enderror" name="nama_skpd" value="{{ old('nama_skpd') }}" required autocomplete="nama_skpd" autofocus>   -->

                       <select id="opd" type="text" class="form-control" name="opd" value="{{ ('opd') }}" class="form-control" data-toggle="select" data-placeholder="Select a state">
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
                      <input id="nama_kegiatan" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required>                   

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
                      <input id="tujuan_kegiatan" type="text" class="form-control @error('tujuan_kegiatan') is-invalid @enderror" name="tujuan_kegiatan" value="{{ old('tujuan_kegiatan') }}" required>                   

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
                      <textarea id="tujuan_pd" type="text" class="form-control @error('tujuan_pd') is-invalid @enderror" name="tujuan_pd" value="{{ old('tujuan_pd') }}" required></textarea>

                      @error('tujuan_pd')
                          <span class="invalid-feedback alert alert-warning" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-2 col-form-label text-md-right">{{ __('Sasaran Perangkat Daerah') }}</label>
                  <div class="col-md-8">
                      <textarea id="sasaran_pd" type="text" class="form-control @error('sasaran_pd') is-invalid @enderror" name="sasaran_pd" value="{{ old('sasaran_pd') }}" required></textarea>                  

                      @error('sasaran_pd')
                          <span class="invalid-feedback alert alert-warning" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-2 col-form-label text-md-right">{{ __('Kegiatan yang Mendukung Capaian Sasaran Perangkat Daerah') }}</label>
                  <div class="col-md-8">
                      <textarea id="capaian" type="text" class="form-control @error('capaian') is-invalid @enderror" name="capaian" value="{{ old('capaian') }}" required></textarea>                  

                      @error('capaian')
                          <span class="invalid-feedback alert alert-warning" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-2 col-form-label text-md-right">{{ __('Detail Tujuan Kegiatan') }}</label>
                  <div class="col-md-8">
                      <input id="tujuan" type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" value="{{ old('tujuan') }}" required>                  

                      @error('tujuan')
                          <span class="invalid-feedback alert alert-warning" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group">
                <div class="col-md-18">
                    <button type="submit" class="btn btn-primary float-xl-right" style="margin-right: 300px; margin-bottom: 18px;">
                          {{ __('Submit') }}
                      </button>
                  </div>
              </div>
      </form>