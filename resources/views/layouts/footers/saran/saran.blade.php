   <form id="saran-form" class="ajax-form">
    <div class="col-lg-5 col-md-6" style="margin-left: 180px;">
      <h2 class="text-white"><b><i class="ni ni-curved-next"></i> Saran</b></h2>
    </div>
  	<div class="row">
  	  <div class="col-md-6">
  	    <div class="form-group">
  	      <input type="text" class="form-control form-control-alternative" id="nama" name="nama" required autofocus placeholder="{{ __('Nama') }}"/>
  	    </div>
  	  </div>
  	  <div class="col-md-6">
  	    <div class="form-group">
  	      <input type="email" class="form-control form-control-alternative" id="email" name="email" placeholder="email_saya@gmail.com">
  	    </div>
  	  </div>
  	</div>
  	<div class="row">
  	  <div class="col-md-12">
  	    <div class="form-group">
  	      <input type="text" class="form-control form-control-alternative" id="nama_instansi" name="nama_instansi" required autofocus placeholder="{{ __('Nama Instansi') }}"required/>
  	    </div>
  	  </div>
  	</div>
  	<div class="row">
  	  <div class="col-md-12">
  	    <div class="form-group">
  	        <textarea class="form-control form-control-alternative" rows="3" id="isi" name="isi" placeholder="Tulis saran anda disini . . ."></textarea>
  	    </div>
  	  </div>
  	</div>
  <button type="submit" style="border-bottom-right-radius: 25px; left: 85.5%;" class="btn btn-primary">Kirim</button>
</form>