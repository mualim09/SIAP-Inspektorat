
<!-- semester 1 nav section -->
@section('nav_tab_semester_1')
<li class="nav-item">
  <a class="nav-link" href="#smt-1-tab" role="tab" aria-controls="semester-tab" aria-selected="true" id="tab-smt-1">Januari - Juni</a>
</li>
@endsection


<!-- semester 2 nav section -->
@section('nav_tab_semester_2')
<li class="nav-item">
  <a class="nav-link" href="#smt-2-tab" role="tab" aria-controls="semester-tab" aria-selected="false" id="tab-smt-2">Juli - Desember</a>
</li>
@endsection


<!-- tab content semester 1 -->
@section('tab_content_semester_1')
<div class="tab-pane" id="semester-1" role="tabpanel" aria-labelledby="semester-1-tab">
  <h4 class="text-center"> Periode Januari - Juni {{ now()->year }} </h4>
  
</div>
@endsection


<!-- tab content semester 2 -->
@section('tab_content_semester_2')
<div class="tab-pane" id="semester-2" role="tabpanel" aria-labelledby="semester-2-tab">
  <h4 class="text-center"> Periode Juli - Desember {{ now()->year }} </h4>
  
</div>
@endsection