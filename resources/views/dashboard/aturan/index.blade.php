@extends('layouts.dashboard')

@section('content')
<h1 class="display-6">Aturan</h1>
<a href="/export-aturan" class="btn btn-danger mt-2">Export PDF</a>
<table class="table mt-3">
    <thead style="background-color: #F6F1E9;">
      <tr>
        <td scope="col">No.</td>
        <td scope="col">Nama Jerawat</td>
        <td scope="col">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $item)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->nama}}</td>
            <td>
              <div data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-content="{{$item}}" class="badge bg-primary"><i class="bi bi-gear"></i></i></div>
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
          <div id="value_gejala">
          </div>
          
          <hr>
            <div id="gejala_penyakit" class="d-flex gap-4 flex-wrap"></div>
            <button id="btn_simpan" onclick="simpan()" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
    <script>

        function setValueGejala(id,nama){
          let gejala = document.querySelector('#value_gejala')
            let element = `<button data-id='${id}' data-nama='${nama}' type="button" class="btn my-1 me-2 btn-sm btn-gejala btn-primary position-relative">
              ${nama}
              <span onclick='deleteValueGejala(${id})' class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                x
              </span>
            </button>`
            if(!gejala.innerHTML.includes(element)){
              gejala.innerHTML += element
            }
        }

        function deleteValueGejala(id){
            document.querySelector('button[data-id="'+id+'"]').remove()
        }
        
        axios.get('/get-gejala').then(e=>{
            let container_obat = document.querySelector("#gejala_penyakit")
            e.data.forEach(item=>{
                let cont = document
                let label = document.createElement('label');
                label.setAttribute('class','d-flex justify-content-between align-items-center gap-1')
                // Buat elemen <input> dengan tipe "checkbox" untuk setiap pilihan
                let input = document.createElement('button');
                input.setAttribute('type', 'button');
                input.setAttribute('name', 'gejala[]');
                input.setAttribute('class','value_gejala btn btn-primary btn-sm')
                input.setAttribute('data-id',item.id)
                input.innerHTML = '+'
                // Tambahkan teks pilihan ke dalam elemen <label>
                label.textContent = item.nama;
                // Tambahkan elemen <input> ke dalam elemen <label>
                label.appendChild(input);
                label.setAttribute('style','width: 40%')
                // Tambahkan elemen <label> ke dalam elemen <div>
                container_obat.appendChild(label);
            })
        }).then(z=>{
            document.querySelectorAll('.value_gejala').forEach(function(btn){
                btn.addEventListener('click',function(){
                  setValueGejala(btn.getAttribute('data-id'),btn.previousSibling.textContent)
                  console.log(value_gejala)
                })
            })
        })

        const modal = document.getElementById('exampleModal')
        
        modal.addEventListener('show.bs.modal', event => {
          document.querySelector('#value_gejala').innerHTML = ''
        const form = modal.querySelector('.modal-body form')
        const modalTitle = modal.querySelector('.modal-title')
        const button = event.relatedTarget
        let data = button.getAttribute('data-bs-content')
   
        data = JSON.parse(data)
        document.querySelector('#btn_simpan').setAttribute('data-id',data.id)
        modalTitle.textContent = data.nama

        axios.get('/get-aturan/'+data.id).then(e=>{
          console.log(e)
              e.data.forEach(el=>{
                setValueGejala(el.id,el.nama)
              })

            })
        })

  function simpan(){
    let value = []
    document.querySelectorAll('.btn-gejala').forEach(el=>{
      value.push({
        id_penyakit: document.querySelector('#btn_simpan').getAttribute('data-id'),
        id_gejala: el.getAttribute('data-id')
      })
    })
    
    axios.post('/aturan',{
        data: value
    }).then(e=>{
        if(e.status == 200){
        location.reload();
      }
    })

  }

    </script>
@endpush