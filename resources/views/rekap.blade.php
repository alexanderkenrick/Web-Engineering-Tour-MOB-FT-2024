@extends('layouts.app')

@section('css')
    <style type="text/css">
        #rekap-section {
            color: #ffffff;
        }

        .title {
            color: #ffffff;
        }

        .no-soal{
            width: 400px;
        }

        .table-responsive{
            width: 100%;
            max-height: 700px;
        }

        .table{
            width: 9000px;
            
        }

        .table-dark{
            position: sticky;
            top: 0;
        }

    </style>
@endsection

@section('content')
    <section id="rekap-section">
        <div class="header">
            <h1 class="title">Rekap</h1>
        </div>
        <div class="container-fluid px-5">
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">NRP</th>
                            <th style="width:100px;">Kelompok</th>
                            @for ($i = 1; $i <= 22; $i++)
                                <th class="no-soal" style="text-align:center">{{ $i }}</th>
                            @endfor

                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="content">
                        @foreach ($students as $student)
                        <tr>
                            <td scope="row">{{ $student->username }}</td>
                            <td>{{$student->group}}</td>
                            @php
                                $counter = 1;    
                            @endphp
                            @foreach ($student->answers as $ans)
                                @while($ans->pivot->question_id != $counter) 
                                    <td class="no-soal"></td>
                                    @php
                                        $counter += 1;    
                                    @endphp
                                
                                @endwhile
                                <td class="no-soal">{{ $ans->pivot->answer}}</td>
                                @php
                                    $counter += 1;    
                                @endphp
                            @endforeach
                            @while($counter < 23) 
                                <td class="no-soal"></td>
                                @php
                                    $counter += 1;    
                                @endphp
                            @endwhile
                        </tr>
                        @endforeach
                        

                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection

@section('script')
<script type="text/javascript">
    // const changeGroup = () => {
    //     let group = $('#select-team').val()

    //     let content = document.getElementById('content')
    //     content.innerHTML = ''
        
    //     $.ajax({
    //         type: 'GET',
    //         url: '{{ route("rekap") }}',
    //         data: {
    //             '_token': '<?php echo csrf_token(); ?>',
    //             'group': group,
    //         },
    //         success: function(data) {
    //             data.students.forEach(student => {
    //                 let counter = 1
    //                 let data = ""
    //                 // alert(student.group)
    //                 let a = student.answers
    //                 console.log(a)
    //                 student.answers.forEach(ans => {
    //                     while (ans.pivot.question_id != counter) {
    //                         data += '<td class="no-soal"></td>'
    //                         counter += 1
    //                     }
    //                     data += `<td class="no-soal">${ans.pivot.answer}</td>`
    //                     counter += 1
    //                 });

    //                 while (counter < 21) {
    //                     data += '<td class="no-soal"></td>'
    //                     counter += 1
    //                 }

    //                 content.innerHTML += `<tr>`
    //                 content.innerHTML += data        
    //                 content.innerHTML += `</tr>`
    //             })
    //         }
    //     })
    // }
</script>
@endsection
