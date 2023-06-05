@extends('layouts.dashboard')

@section('content')
<div class="d-flex gap-4">
    <div class="card w-100 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Data User</div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h1 class="p">{{$data['jml_user']}}</h1>
            <i class="bi bi-person-circle" style="font-size: 50px"></i>
          </div>
        </div>
      </div>
      <div class="card w-100 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Data Report</div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="p">{{$data['jml_report']}}</h1>
                <i class="bi bi-bar-chart-fill" style="font-size: 50px"></i>
              </div>
        </div>
      </div>
      <div class="card w-100 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Data Penyakit</div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="p">{{$data['jml_penyakit']}}</h1>
                <i class="bi bi-clipboard2-pulse-fill" style="font-size: 50px"></i>
              </div>
        </div>
      </div>
</div>

<div class="row">
  <div class="col-5">
    {!! $chart->container() !!}
  </div>
  <div class="col-7">
    {!! $chart2->container() !!}
  </div>
</div>



@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
{!! $chart2->script() !!}
@endpush
