@extends('layouts.dashboard')

@section('content')
<h1 class="display-6">Data Admin</h1>
<div class="d-flex mt-3 justify-content-between align-items-center">
  <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="bi bi-calendar2-plus"></i> Tambah</button>
  <a href="/export-admin" class="btn btn-danger">Export PDF</a>
</div>
<table class="table mt-4">
    <tr style="background-color: #F6F1E9;">
        <th>Nama</th>
        <th>Role</th>
        <th></th>
    </tr>
    @foreach ($data as $item)
    <tr>
        <td>{{$item->email}}</td>
        <td>{{$item->role}}</td>
        <td>
          <div data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-content="{{$item}}" class="badge bg-primary"><i class="bi bi-pencil-square"></i></div>
          <div data-id="{{$item->id}}" class="delete-data badge bg-danger"><i class="bi bi-trash3"></i></div>
        </td>
    </tr>
    @endforeach
</table>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" id="form_upload">
                @csrf
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="email">
                            <small id="error_email" class="text-danger"></small>
                          </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Role</label>
                          <select class="form-select" name="role">
                            <option selected>Select role</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="dokter">Dokter</option>
                          </select>
                          <small id="error_role" class="text-danger"></small>
                        </div>
                  </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Password</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="password">
                            <small id="error_password" class="text-danger"></small>
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
        modalTitle.textContent = `Tambah Admin`
        form.id.value = null

        if(data){ // jika tombol edit ditekan
          data = JSON.parse(data)
          
          modalTitle.textContent = `Edit Admin`
          form.email.value = data.email
          form.id.value = data.id
          form.role.value = data.role
        }
      })

      document.querySelector("#form_upload").addEventListener('submit',function(e){
      e.preventDefault()
      let formData = new FormData(this)

      if(formData.get('id')){ //  jika ada value id, maka ubah method nya ke PUT
        formData.append('_method','PUT')
      }
      axios({
        url: '/admin',
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
    swal({
      title: "Ingin menghapus data ini ?",
      text: "Klik OK untuk konfirmasi",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        axios.post('/admin/'+this.getAttribute('data-id'),{
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