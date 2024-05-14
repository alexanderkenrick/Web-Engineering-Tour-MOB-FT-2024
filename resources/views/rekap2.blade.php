@extends('layouts.app')

@section('css')

    <style type="text/css">
        #rekap-section {
            color: #ffffff;
        }

        .title {
            color: #ffffff;
        }

        .card{
            margin-bottom: 16px;
            max-width: 100%;
        }

    </style>
@endsection

@section('content')
    <section id="rekap-section">
        <div class="header">
            <h1 class="title">Rekap</h1>
        </div>
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-5 text-end col-sm-6">
                    <label for="select-team">Kelompok :</label>
                </div>
                <div class="col-7 col-sm-6">
                     {{-- Team Select --}}
                     <div class="team-select-section">
                        <select name="select-team" id="select-team" class="select2 w-100" onchange="changeGroup()">
                            <option value="" disabled selected>--Pilih Kelompok--</option>
                            @foreach ($groups as $group)
                            <option value="{{ $group->group }}">{{ $group->group }}</option>
                        @endforeach
                        </select>
                    </div>
                    {{-- <select name="select-team" id="select-team" onchange="changeGroup()">
                        <option value="" disabled selected>--Pilih Kelompok--</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->group }}">{{ $group->group }}</option>
                        @endforeach
                    </select> --}}
                </div>
            </div>
            <div class="row my-2">
                <div class="col-5 text-end col-sm-6">
                    <label for="select-student">Mahasiswa :</label>

                </div>
                <div class="col-7 col-sm-6">
                    <select name="select-student" id="select-student" class="select2" onchange="changeStudent()">
                        <option value="" disabled selected>--Pilih Mahasiswa--</option>
                    </select>
                </div>
            </div> 

            

        </div>

        <div class="m-5" id="answers">
            {{-- <div class="card">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis quis repudiandae iure veritatis! Tempora repellat alias veritatis ea veniam modi dolor quisquam, sit doloremque, dolore tenetur soluta quaerat molestias odit.
                </div>
            </div> --}}
        </div>
    </section>
@endsection

@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
    const changeGroup = () => {
        let group = $('#select-team').val()
        $('#select-student').html("<option value='' disabled selected>--Pilih Mahasiswa--</option>")
        
        let answers = document.getElementById('answers')
        answers.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("change.group") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'group': group,
            },
            success: function(data) {
                data.students.forEach(student => {
                    $("#select-student").append(new Option(student.username + ' - ' + student.name, student.id));
                })
            }
        })
    }

    const changeStudent = () =>{
        let student_id = $('#select-student').val()
        let answers = document.getElementById('answers')
        answers.innerHTML = ''

        let gedungs = ['Gedung TA', 'Gedung TB','Gedung TC','Gedung TD','Gedung TE','Gedung TF','Gedung TG']

        $.ajax({
            type: 'POST',
            url: '{{ route("change.student") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'student_id': student_id,
            },
            success: function(data) {
                for (i = 1; i <= 35; ++i) {
                    let nomor = i % 5
                    if(i % 5 == 0){
                        nomor = 5
                    }

                    if((i+4) % 5 == 0){
                        $('#answers').append('<div class="card"><div class="card-body" id="gedung-'+Math.floor(i/5)+'">')

                        $("#gedung-"+Math.floor(i/5)).append("<h3>" + gedungs[Math.floor(i/5)] + "</h3>")
                    }

                    let valid = false
                    let wkwk = i
                    if(i%5 == 0){
                        wkwk -=1
                    }
                    data.answers.forEach(a => {
                        if(a.question_id == i){
                            valid = true
                            
                            $("#gedung-"+Math.floor(wkwk/5)).append("<p>" + nomor + ". " + a.answer + "</p>")
                            // $("#answers").append("<p>" + nomor + ". " + a.answer + "</p>")
                        }
                    })

                    if(!valid){
                        $("#gedung-"+Math.floor(wkwk/5)).append("<p>" + nomor + ". No answer" + "</p>")
                    }
                }


            }
        })
    }
</script>
@endsection