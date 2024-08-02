@extends('layouts.app')

@section('css')
    <link href="https://unpkg.com/nes.css@2.3.0/css/nes.min.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/party-js@latest/bundle/party.min.js"></script>
    <style>
.content-qr-reader{
    width: 100%;
    max-width: 500px;
    margin-top: auto;
    margin-bottom: auto;
}

.content-qr-reader h1 {
    color: black;
}

.form-question{
    font-size: 12pt;
}
.form-question p{
    font-weight: bold;
    margin: 0 !important;
}

.section-qr-reader {
    background-color: #ffffff;
    padding: 50px 20px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
    width: 100%;
}

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
}

#my-qr-reader img[alt="Info icon"] {
    display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
    width: 100px !important;
    height: 100px !important;
}
    </style>
@endsection

@section('content')
    <section class="map-section" id="ini-map">
        {{-- <div class="space">
            <img src="{{ asset('../images/assets_spacecraft/Spacecraft' . $count . '.png') }}" id="spacecraft" alt="">
        </div> --}}
        {{-- <img src="{{ asset('../images/assets_gedung/awan-1.png') }}" id="awan-1" alt="">
        <img src="{{ asset('../images/assets_gedung/awan-3.png') }}" id="awan-3" alt="">
        <img src="{{ asset('../images/assets_gedung/awan-5.png') }}" id="awan-5" alt=""> --}}
        {{-- <img src="{{ asset('../images/assets_gedung/bird.png') }}" id="bird-1" alt=""> --}}
        <h1 class="title-depan" style="z-index:5">Engineering Tour</h1>
        <div class="container-fluid my-0 my-4">
            <div class="row my-5">
                <div class="col  d-flex justify-content-center">

                    <div class="map-container">
                        <img src="{{ asset('../images/assets_mob24/Maps.png') }}" class="map_image"
                            alt="">
                        @if (!array_search(1, $pos))
                            <img src="{{ asset('../images/assets_mob24/TA.png') }}" alt="" class="point"
                                id="ta-bw">
                        @endif
                        @if (!array_search(2, $pos))
                            <img src="{{ asset('../images/asset_mob24/TB.png') }}" alt="" class="point"
                                id="tb-bw">
                        @endif
                        @if (!array_search(3, $pos))
                            <img src="{{ asset('../images/asset_mob24/TC.png') }}" alt="" class="point"
                                id="tc-bw">
                        @endif
                        @if (!array_search(4, $pos))
                            <img src="{{ asset('../images/asset_mob24/TD.png') }}" alt="" class="point"
                                id="td-bw">
                        @endif
                        @if (!array_search(5, $pos))
                            <img src="{{ asset('../images/asset_mob24/TE.png') }}" alt="" class="point"
                                id="te-bw">
                        @endif
                        @if (!array_search(6, $pos))
                            <img src="{{ asset('../images/asset_mob24/TF.png') }}" alt="" class="point"
                                id="tf-bw">
                        @endif
                        @if (!array_search(7, $pos))
                            <img src="{{ asset('../images/asset_mob24/TG.png') }}" alt="" class="point"
                                id="tg-bw">
                        @endif

                        @if($current_pos==1)
                        <img src="{{ asset('../images/checkpoint.png') }}" class="check-ta" id="checkpoint" alt="">
                        @endif
                        @if($current_pos==2)
                        <img src="{{ asset('../images/checkpoint.png') }}" class="check-tb" id="checkpoint" alt="">
                        @endif
                        @if($current_pos==3)
                        <img src="{{ asset('../images/checkpoint.png') }}" class="check-tc" id="checkpoint" alt="">
                        @endif
                        @if($current_pos==4)
                        <img src="{{ asset('../images/checkpoint.png') }}" class="check-td" id="checkpoint" alt="">
                        @endif
                        @if($current_pos==5)
                        <img src="{{ asset('../images/checkpoint.png') }}" class="check-te" id="checkpoint" alt="">
                        @endif
                        @if($current_pos==6)
                        <img src="{{ asset('../images/checkpoint.png') }}" class="check-tf" id="checkpoint" alt="">
                        @endif
                        @if($current_pos==7)
                        <img src="{{ asset('../images/checkpoint.png') }}" class="check-tg" id="checkpoint" alt="">
                        @endif
                    </div>
                </div>
            </div>

            GAMBARNYA BELUM SIAP YA, NANTI DIGANTI HARAP BERSABAR 😉!!!
            <div class="row  d-flex justify-content-center  my-4">
                <div class="col d-flex justify-content-center">
                    <!-- QR Scanner -->
                    <div class="container-qr-reader">
                        <div class="content-qr-reader">
                            <h1 class="title-depan" style="color: #FBC907;">Scan QR Codes</h1>
                            <div class="section-qr-reader">
                                <div id="my-qr-reader">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End QR Scanner -->
                </div>

            </div>

            <dialog class="is-rounded" id="dialog-question">
                {{-- <form method="dialog"> --}}
                <p class="title" id="titles" style="color: #390203;">Ini Judul</p>

                <form action="{{route('submit.answers')}}" method="post" class="form">
                    @csrf
                    <div class="form-question">

                    </div>

                    <div class="dialog-menu">
                        <button class="btn btn-primary bricolage" style="background-color: #390203; color: white;" type="submit">Submit</button>
                    </div>
                </form>

                {{-- </form> --}}
            </dialog>

            <!-- Modal -->
            {{-- <div class="modal fade" id="modal_congrats" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h1 class="fs-5 text-mob">Congratulation</h1>
                        </div>
                    </div>
                </div>
            </div> --}}

            <dialog class="nes-dialog is-rounded" id="modal_congrats">
                <p class="title">Congrats</p>
                <p id="quest">Cie sudah selesai kerjain Engineering Tour.</p>
                <div class="dialog-menu">
                    <div class="confirm-section">
                        <button class="nes-btn is-primary" onclick="closeModal1()">Close</button>
                    </div>
                </div>
            </dialog>

        </div>
    </section>

@endsection

@section('script')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            @if(session('status')=='success')
                showSwal('success', 'Success', '{{ session('message') }}')
            @elseif(session('status')=='error')
                showSwal('error', 'Error', '{{ session('message') }}')
            @endif


        });

        $(window).on('load', function() {
            count = {{ $count }};

            if (count == 7){
                document.getElementById('modal_congrats').showModal()
                let element = document.getElementById('ini-map')
                party.confetti(element, {
                    zIndex: 9999,
                    count: party.variation.range(40, 50),
                });
            }
        });
        let questions = []
        let current = 0
        // let answers = ['', '', '']
        let options = []
        let pos = "";

        function loadingState(title ,message){
            Swal.fire({
                icon: 'info',
                animation: true,
                title: title,
                text: message,
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false,
                showDenyButton:false,
                showCancelButton: false,
                didOpen: () =>{
                    Swal.showLoading();
                },
            });
        }

        function showSwal(icon, title, text){
            Swal.fire({
                icon: icon,
                animation: true,
                title: title,
                text: text,
                duration: 2000,
                timerProgressBar: true,
            });
        }

        const closeModal1 = () => {
            document.getElementById('modal_congrats').close()
        }

        const submit = () => {
            if (!confirm("Are you sure?")) return

            const invalid = answers.includes("");
            if (invalid) {
                alert('You have to answer all the questions')
            } else {

                let pass = $('#input-password').val().toUpperCase()
                $.ajax({
                    type: 'POST',
                    url: '{{ route('submit.answers') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'pass': pass,
                        'answers': answers,
                    },
                    success: function(data) {
                        alert(data.msg)
                        location.reload()
                    }
                })
            }
        }
        const html5QrCode = new Html5Qrcode(
            "my-qr-reader", { formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ] });

        let qrConfig = {
            fps:10,
            qrbox:250,
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA, Html5QrcodeScanType.SCAN_TYPE_FILE],
        }
        // var html5QrcodeScanner = new Html5QrcodeSc   anner(
        //     "my-qr-reader", qrConfig, false);

        // html5QrcodeScanner.start(onScanSuccess);

        var cameraId;
        Html5Qrcode.getCameras().then(devices => {
            cameraId = devices[devices.length-1].id
            // console.log(devices)
            // console.log(cameraId)
        })

        html5QrCode.start({ facingMode: 'environment' }, qrConfig, onScanSuccess);

        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            // console.log(`Scan result: ${decodedText}`, decodedResult);
            // let url = `/qr-scanner/detail/${decodedText}`;
            loadingState("Checking", "Mohon ditunggu...")
            html5QrCode.stop();
            let pass = `${decodedText}`;

            $.ajax({
                type: 'POST',
                url: '{{ route('check.pass') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'pass': pass,
                },
                success: function(data) {
                    if (data.msg == "GET") {
                        // current = 0
                        pos = data.pos
                        alert("You are in " + pos)
                        document.getElementById('dialog-question').showModal()
                        $('#titles').text(pos)
                        questions = data.questions[0]

                        var questionData = "";
                        questions.forEach( function(question, index){
                            idQuest = "#quest-"+(index+1)
                            $(idQuest).text(question)
                            questionData +=
                                `
                                    <p id="quest-${index+1}">${index+1}. ${question.question}</p>
                                    <div class="d-flex">
                                        <div class="mx-2"> <input type="radio" name="question[${question.id}][option]" id="option${index+1}-1" value="${question.option[0].id}" required></div>
                                        <div class="flex-grow-1"> <label for="option${index+1}-1" id="labelOption${index+1}-1">${question.option[0].option_text}</label></div>
                                    </div>
                                   <div class="d-flex">
                                        <div class="mx-2"><input type="radio" name="question[${question.id}][option]" id="option${index+1}-2" value="${question.option[1].id}"></div>
                                        <div class="flex-grow-1"> <label for="option${index+1}-2" id="labelOption${index+1}-2">${question.option[1].option_text}</label></div>
                                    </div>
                                     <div class="d-flex">
                                        <div class="mx-2"><input type="radio" name="question[${question.id}][option]" id="option${index+1}-3" value="${question.option[2].id}"></div>
                                        <div class="flex-grow-1"><label for="option${index+1}-3" id="labelOption${index+1}-3">${question.option[2].option_text}</label></div>
                                    </div>
                                     <div class="d-flex">
                                        <div class="mx-2"><input type="radio" name="question[${question.id}][option]" id="option${index+1}-4" value="${question.option[3].id}"></div>
                                        <div class="flex-grow-1"><label for="option${index+1}-4" id="labelOption${index+1}-4">${question.option[3].option_text}</label></div>
                                    </div>
                                    `
                        });
                        questionData += `
                            <input type="hidden" name="posId" value="${questions[0].pos_id}">
                            `
                        $(".form-question").html(questionData)
                        Swal.close()

                        // $('#answer').focus()
                    } else if (data.msg == "INVALID") {
                        $('#input-password').val("")
                        $('#input-password').focus()
                        Swal.close()
                        showSwal('error', 'Oops', 'Pertanyaan telah terjawab')
                        html5QrCode.start({ deviceId: {exact  : cameraId} }, qrConfig, onScanSuccess);
                    } else {
                        Swal.close()
                        showSwal('error', 'Oops', 'Password salah')
                        $('#input-password').val("")
                        $('#input-password').focus()
                        html5QrCode.start({ deviceId: {exact  : cameraId} }, qrConfig, onScanSuccess);

                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                    html5QrCode.start({ deviceId: {exact  : cameraId} }, qrConfig, onScanSuccess);
                    Swal.close()
                }
            })
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        // function onScanError(errorMessage) {
        //     // handle on error condition, with error message
        //     console.log(errorMessage)
        // }
    
    </script>
{{--    <script src="{{ asset('js/qr-reader.js') }}"></script>--}}
@endsection
