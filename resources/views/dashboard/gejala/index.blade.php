@extends('layouts.dashboard')

@section('content')
<h1 class="display-6">Gejala</h1>
<div class="d-flex justify-content-between mt-3">
  <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="bi bi-calendar2-plus"></i> Tambah</button>
  <a href="/export-gejala" class="btn btn-danger">Export PDF</a>
</div>

<table class="table mt-4">
    <thead style="background-color: #F6F1E9;">
      <tr>
        <td scope="col">No.</td>
        <td scope="col">Nama Penyakit</td>
        <td scope="col">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $item)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->nama}}</td>
            <td>
              <div data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-content="{{$item}}" class="badge bg-primary"><i class="bi bi-pencil-square"></i></div>
              <div data-id="{{$item->id}}" class="delete-data badge bg-danger"><i class="bi bi-trash3"></i></div>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis Jerawat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" id="form_upload">
                @csrf
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama">
                            <small id="error_nama" class="text-danger"></small>
                          </div>
                    </div>
                </div>                
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
    <script>
      const modal = document.getElementById('exampleModal')
      modal.addEventListener('show.bs.modal', event => {
        const form = modal.querySelector('.modal-body form')
        const modalTitle = modal.querySelector('.modal-title')
        const button = event.relatedTarget
        let data = button.getAttribute('data-bs-content')
        modalTitle.textContent = `Tambah Gejala`
        form.id.value = null

        if(data){ // jika tombol edit ditekan
          data = JSON.parse(data)
          
          modalTitle.textContent = `Edit Gejala`
          form.nama.value = data.nama
          form.id.value = data.id
        }
        
      })

      document.querySelector("#form_upload").addEventListener('submit',function(e){
        e.preventDefault()
        let formData = new FormData(this)

        if(formData.get('id')){ //  jika ada value id, maka ubah method nya ke PUT
          formData.append('_method','PUT')
        }
        axios({
          url: '/gejala',
          data: formData,
          method: 'POST',
        }).then(e=>{ 
          if(e.status == 200){
            location.reload();
          }
        }).catch(error=>{
          if (error.response.status === 422) {
        const errors = error.response.data.errors;
        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
                const errorMessage = errors[key][0];
                const errorSpan = document.getElementById(`error_${key}`);
                errorSpan.innerHTML = errorMessage;
            }
        }
        } else {
        }
        })
      })

      let btn_delete = document.querySelectorAll(".delete-data")
      btn_delete.forEach(button => {
        button.addEventListener('click',function(){
        console.log(this.getAttribute('data-id'))
        swal({
          title: "Ingin menghapus data ini ?",
          text: "Klik OK untuk konfirmasi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.post('/gejala/'+this.getAttribute('data-id'),{
              _method: 'DELETE'
            }).then(e=>{
              if(e.status == 200){
                location.reload();
              }
            })
          }
        });
        })
      })
      
    </script>
@endpush
            
        