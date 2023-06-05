@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="row">
                <div class="col-9">
                    <div class="mb-5 d-flex align-items-center justify-content-between">
                        <div id="jml_pertanyaan">Pertanyaan ke - 1</div>
                        <button class="btn btn-danger" onclick="reset()">Reset</button>
                    </div>
                
                    <h4 id="pertanyaan"></h4>
                    <button id="btn_ya" onclick="submitJawaban('ya')" class="btn btn-outline-dark w-100 mt-4">Ya</button>
                    <button  id="btn_tidak" onclick="submitJawaban('tidak')" class="btn btn-outline-dark w-100 mt-3">Tidak</button>
                    <div class="mt-3 d-flex justify-content-center gap-3">
                        <button class="btn btn-primary" onclick="btnPrevious()"><i class="bi bi-caret-left-fill"></i></button>
                        <button class="btn btn-primary" onclick="btnNext()"><i class="bi bi-caret-right-fill"></i></button>
                    </div>
                    
                </div>
                <div class="col-3">
                    <div class="d-flex flex-wrap gap-2">
                        @for ($i = 1; $i <= 28; $i++)
                            <button onclick="klikSoal({{$i}})" data-soal="{{$i}}" class="button-soal">{{$i}}</button>
                        @endfor
                    </div>
    
                        <button onclick="selesai()" id="btn_selesai" class="btn w-100 mt-4 text-white mx-auto d-none" style="background-color: green">Selesai</button>
       
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        if(localStorage.getItem('isDone') == 'done'){
            window.location = '/report'
        }
        if(!localStorage.getItem('nama') || !localStorage.getItem('no_telp')){
            window.location = '/#form-tes'
        }
        let gejala = {!! json_encode($gejala) !!}
        let index = Number(localStorage.getItem('index'))
        let jawaban = JSON.parse(localStorage.getItem('jawaban')) ?? []
        
        showSoal()

        function showSoal(){
            document.querySelector('#btn_tidak').classList.replace('btn-primary','btn-outline-dark')
            document.querySelector('#btn_ya').classList.replace('btn-primary','btn-outline-dark')

            document.querySelector('#jml_pertanyaan').innerHTML = `Pertanyaan ke ${index+1}/${gejala.length}`
            document.querySelector('#pertanyaan').innerHTML = `Apakah anda mengalami gejala ${gejala[index].nama}`

            const foundObj = jawaban.find(({ id_gejala }) => id_gejala === gejala[index].id);
            if(foundObj){
                console.log(foundObj.value == 'ya')
                if(foundObj.value == 'ya'){
                    console.log(document.querySelector('#btn_ya'))
                    document.querySelector('#btn_ya').classList.replace('btn-outline-dark','btn-primary')
                    document.querySelector('#btn_tidak').classList.remove('btn_primary')
                }else{
                    document.querySelector('#btn_tidak').classList.add('btn-outline-dark','btn-primary')
                    document.querySelector('#btn_ya').classList.remove('btn-primary')
                }
            }
        }
        function klikSoal(e){
            index = Number(e-1)
            showSoal()
        }
        function isDone(){
            if(jawaban.length == gejala.length){
                document.querySelector('#btn_selesai').classList.remove('d-none')
            }else{
                document.querySelector('#btn_selesai').classList.add('d-none')
            }
        }

        function btnNext(){
            if(index >= (gejala.length - 1)){
                return
            }
            index++;
            localStorage.setItem('index',index)
            showSoal()
        }

        function btnPrevious(){
            if(index <= 0){
                return
            }
            index--;
            localStorage.setItem('index',index)
            showSoal()
        }

        function submitJawaban(jwb){
            document.querySelector('.button-soal[data-soal="'+(index+1)+'"]').classList.add('active')
            if(jwb == 'ya'){
                document.querySelector("#btn_ya").classList.replace('btn-outline-dark','btn-primary')
                document.querySelector('#btn_tidak').classList.replace('btn-primary','btn-outline-dark')
            }else{
                document.querySelector("#btn_tidak").classList.replace('btn-outline-dark','btn-primary')
                document.querySelector('#btn_ya').classList.replace('btn-primary','btn-outline-dark')
            }

            const foundObj = jawaban.find(({ id_gejala }) => id_gejala === gejala[index].id);
            if (foundObj) {
                Object.assign(foundObj,{
                id_gejala: gejala[index].id,
                value: jwb
            })
            }else{
                jawaban.push({
                id_gejala: gejala[index].id,
                value: jwb
             })
            }
            localStorage.setItem('jawaban',JSON.stringify(jawaban))
            isDone()
        }

        function reset(){
            localStorage.removeItem('index')
            localStorage.removeItem('jawaban')
            location.reload()
        }

        function selesai(){
            axios.post('/sistem',{
                no_telp: localStorage.getItem('no_telp'),
                jawaban: JSON.parse(localStorage.getItem('jawaban'))
            }).then(e=>{
                window.location = '/report'
            })
        }
    </script>
@endpush