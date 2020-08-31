<div class="header bg-gradient-primary default-color" style="padding-top: 3rem !important;padding-bottom: 2.4rem !important;">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            @if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
            
        </div>
    </div>
</div>