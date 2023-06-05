@extends('layouts.dashboard')

@section('content')
<h1 class="display-6">Data User</h1>
<div class="d-flex mt-3 justify-content-between">
  <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="bi bi-calendar2-plus"></i> Tambah</button>
  <a href="/export-user" class="btn btn-danger">Export PDF</a>
</div>

<table class="table mt-4">
    <tr style="background-color: #F6F1E9;">
        <th>Nama User</th>
        <th>No. Telp</th>
        <th></th>
    </tr>
    @foreach ($data as $item)
    <tr>
        <td>{{$item->nama}}</td>
        <td>{{$item->no_telp}}</td>
        <td>
          <div data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-content="{{$item}}" class="badge bg-primary"><i class="bi bi-pencil-square"></i></div>
          <div data-id="{{$item->no_telp}}" class="delete-data badge bg-danger"><i class="bi bi-trash3"></i></div>
        </td>
    </tr>
    @endforeach
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
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama">
                            <small id="error_nama" class="text-danger"></small>
                          </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">No.Telepon</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="no_telp">
                            <small id="error_no_telp" class="text-danger"></small>
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
        modalTitle.textContent = `Tambah User`
        form.id.value = null

        if(data){ // jika tombol edit ditekan
          data = JSON.parse(data)
          
          modalTitle.textContent = `Edit User`
          form.nama.value = data.nama
          form.id.value = data.no_telp
          form.no_telp.value = data.no_telp
        }
        
      })

      document.querySelector("#form_upload").addEventListener('submit',function(e){
      e.preventDefault()
      let formData = new FormData(this)

      if(formData.get('id')){ //  jika ada value id, maka ubah method nya ke PUT
        formData.append('_method','PUT')
      }
      axios({
        url: '/user',
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
        axios.post('/user/'+this.getAttribute('data-id'),{
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