@extends('layouts.dashboard')

@section('content')
<h3>Obat Jerawat</h3>
<a href="/export-obat_penyakit" class="btn btn-danger">Export PDF</a>
<table class="table mt-4">
    <thead style="background-color: #F6F1E9;">
      <tr>
        <td scope="col">No.</td>
        <td scope="col">Nama</td>
        <td scope="col">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $item)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->nama}}</td>
            <td>
              <div data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-content="{{$item}}" class="badge bg-primary">Manajemen Obat</i></div>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Obat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="obat_penyakit" class="d-flex flex-wrap gap-4"></div>
            <button id="btn_simpan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
    <script>
        let value_obat = []
        axios.get('/get-obat').then(e=>{
            let container_obat = document.querySelector("#obat_penyakit")
            e.data.forEach(item=>{
                let cont = document
                let label = document.createElement('label');
                label.setAttribute('class','d-flex gap-1')
                // Buat elemen <input> dengan tipe "checkbox" untuk setiap pilihan
                let input = document.createElement('input');
                input.setAttribute('type', 'checkbox');
                input.setAttribute('name', 'myCheckbox[]');
                input.setAttribute('class','value_obat text-small')
                input.setAttribute('value',item.id)
                // Tambahkan teks pilihan ke dalam elemen <label>
                label.textContent = item.nama;
                // Tambahkan elemen <input> ke dalam elemen <label>
                label.appendChild(input);
                // Tambahkan elemen <label> ke dalam elemen <div>
                container_obat.appendChild(label);
            })
        })

        const modal = document.getElementById('exampleModal')
        
        modal.addEventListener('show.bs.modal', event => {
          document.querySelectorAll('.value_obat').forEach(checkbox=>{
                  checkbox.checked = false
              })
            const form = modal.querySelector('.modal-body form')
            const modalTitle = modal.querySelector('.modal-title')
            const button = event.relatedTarget
            let data = button.getAttribute('data-bs-content')
      
            data = JSON.parse(data)
            document.querySelector('#btn_simpan').setAttribute('data-id',data.id)
            modalTitle.textContent = data.nama

            axios.get('/get-obat-penyakit/'+data.id).then(e=>{
              let id_obat  = []
              e.data.forEach(id=>{
                id_obat.push(id.id_obat)
              })
  
              document.querySelectorAll('.value_obat').forEach(checkbox=>{
                if(id_obat.includes(parseInt(checkbox.value))){
                  checkbox.checked = true
                }
              })
            })
        })

  

  document.querySelector('#btn_simpan').addEventListener("click",function(){
    let data = [];
    const checkboxes = document.querySelectorAll('.value_obat');
    checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        data.push({
          id_penyakit: document.querySelector('#btn_simpan').getAttribute('data-id'),
          id_obat: parseInt(checkbox.value)
        })
      }
      });

    axios.post('/obat-penyakit',{
        data: data
    }).then(e=>{
        if(e.status == 200){
        location.reload();
      }
    })
  })
    </script>
@endpush