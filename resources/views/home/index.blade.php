@extends('layouts.main')

@section('content')
<div class="jumbotron mb-5">
  <div class="container">
      <div class="row">
          <div class="col-6 position-relative">
              <div class="position-absolute" style="top:30%;">
                  <h1>eJerawat</h1>
              <h6>Temukan solusi untuk permasalahan jerawat <br> wajah yang anda alami</h6>
              <a href="/#form-tes" class="shadow btn btn-primary mt-4">Coba Sekarang</a>
              </div>
              
          </div>
          <div class="col-6">
              <img class="img-fluid" src="https://img.freepik.com/free-vector/acne-treatment-concept-illustration_114360-9105.jpg" alt="">
          </div>
      </div>
  </div>
</div>
<div class="container my-4">
    <div class="row">
        <div class="col-md-4 pt-5">
            <h3>Kenali beberapa jenis jerawat</h3>
            <p>Kondisi ini berhubungan dengan produksi minyak (sebum) yang terjadi secara berlebihan.</p>
        </div>
        <div class="col">
            <div class="row">
            @foreach ($penyakit as $item)
            <div class="col-3 my-2 text-center">
                <img style="width: 80px; height: 80px; object-fit:cover; border-radius: 15px;" src="/uploads/{{$item->foto}}" alt="">
                <div>{{$item->nama}}</div>
            </div>
                
            @endforeach
        </div>
        </div>
    </div>
</div>
<div id="form-tes" style="background-color: rgb(238, 236, 233);border-radius: 15px;" class="container w-100 d-flex justify-content-center mt-5 text-center">
    <form id="form_start" class="p-4 w-75 my-4">
        <h3>Tes Online</h3>
        <p>Hanya isi data diri, dan langsung mulai tes</p>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama</label>
          <input type="text" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">No. Telepon</label>
          <input type="text" class="form-control" name="no_telp" id="exampleInputPassword1">
        </div>
        <button onclick="start()" type="button" class="shadow-sm w-100 btn btn-primary"><i class="bi bi-pencil-square"></i> Mulai</button>
      </form>
</div>
@endsection

@push('script')
    <script>
        function start(){
            let data = document.querySelector('#form_start')
            if(!data.nama.value || !data.no_telp.value){
                alert('Wajib Diisi!')
                return
            }
            
            localStorage.setItem('nama',data.nama.value)
            localStorage.setItem('no_telp',data.no_telp.value)
            axios.post('/auth-user',{
                nama: data.nama.value,
                no_telp: data.no_telp.value
            }).then(e=>{
                localStorage.removeItem('index')
                localStorage.removeItem('jawaban')
                localStorage.removeItem('isDone')
                window.location = '/tes-online'
            })
            
        }
    </script>
@endpush

    
