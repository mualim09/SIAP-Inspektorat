<div class="col-xl-7 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-badge mr-2"></i>Profil-Ku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-circle-08 mr-2"></i>Data Pegawai</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false" ><i class="ni ni-calendar-grid-58 mr-2"></i>Messages</a>
                        </li> -->
                    </ul>
            <div class="row align-items-center">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <form autocomplete="off" class="ajax-form">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ isset($profile->id) ?? $profile->id }}">
                                    <input type="hidden" name="user_id" id="user-id" value="{{ auth()->user()->id }}">

                                    <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                                    
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('NIP') }}</span>
                                            <div class="col-md-10">
                                                <input id="first_name" type="text" class="form-control form-control-alternative @error('first_name') is-invalid @enderror" name="first_name" value="{{ auth()->user()->nip }}" required autofocus placeholder="{{ __('NIP') }}" disabled="">

                                                @error('first_name')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('Nama Lengkap') }}</span>
                                            <div class="col-md-5">
                                                <input id="first_name" type="text" class="form-control form-control-alternative @error('first_name') is-invalid @enderror" name="first_name" value="{{ auth()->user()->first_name }}" required autofocus placeholder="{{ __('First name') }}" disabled="">

                                                @error('first_name')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input id="last_name" type="text" class="form-control form-control-alternative @error('last_name') is-invalid @enderror" name="last_name" value="{{ auth()->user()->last_name }}" required placeholder="{{ __('Last name') }}" disabled="">

                                                @error('last_name')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</span>
                                            <div class="col-md-10">
                                                <input id="password" type="password" class="form-control form-control-alternative @error('password') is-invalid @enderror" name="password" value="" required autofocus placeholder="Ganti Password">
                                                <!-- <small></small> -->

                                                @error('password')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>                                                        
                                        <div class="form-group row">
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('Contact Informations') }}</span>
                                            <div class="col-md-5">
                                                <input id="email" type="email" class="form-control form-control-alternative @error('email') is-invalid @enderror" name="first_name" value="{{ auth()->user()->email }}" required placeholder="{{ __('Email') }}" disabled="">

                                                @error('email')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input id="phone" type="text" class="form-control form-control-alternative @error('phone') is-invalid @enderror" name="phone" value="{{ auth()->user()->phone }}" placeholder="{{ __('Phone') }}" disabled="">

                                                @error('phone')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('Pendidikan Terakhir') }}</span>
                                            <div class="col-md-10">

                                                <input id="pendidikanpendidikan" type="text" class="form-control form-control-alternative @error('pendidikan') is-invalid @enderror" name="pendidikan" required autofocus placeholder="{{json_encode(auth()->user()->pendidikan['tingkat'])}} {{json_encode(auth()->user()->pendidikan['jurusan'])}}" disabled="">

                                                @error('pendidikan')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('Ruang') }}</span>
                                            <div class="col-md-5">
                                                <input id="ruang" type="text" class="form-control form-control-alternative @error('email') is-invalid @enderror" name="ruang" value="" required placeholder="{{json_encode(auth()->user()->ruang['nama'])}}{{json_encode(auth()->user()->ruang['jabatan'])}}" disabled="">

                                                @error('email')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <hr class="my-4" />


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <!-- <h3 class="name_lokasi">Tabel Data Pegawai</h3> -->
                            <div class="table-responsive data-user">
                                <table class="table table-striped table-sm ajax-table" id="user-lihat-table">
                                    <thead>
                                        
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>