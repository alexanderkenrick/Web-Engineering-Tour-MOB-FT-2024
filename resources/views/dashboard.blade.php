@extends('layouts.app')

@section('css')
    <link href="https://unpkg.com/nes.css@2.3.0/css/nes.min.css" rel="stylesheet" />
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/party-js@latest/bundle/party.min.js"></script>
    <style>

.content-qr-reader{
    width: 100%;
    max-width: 500px;
    margin: 5px;
    margin-top: auto;
    margin-bottom: auto;
}
 
.content-qr-reader h1 {
    color: black;
}
 
.section-qr-reader {
    background-color: #ffffff;
    padding: 50px 30px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
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
    {{-- <div class="blocker">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://lottie.host/f0c83d85-3b47-4b77-990c-3245f810b85e/dguz1WhP5f.json" background="#000000"
            speed="1" style="width: 250px; height: 250px" direction="1" mode="normal" loop autoplay></lottie-player>
        <h2 class="rotate-phone-text">Please Rotate Your Phone</h2>
    </div> --}}

    <section class="map-section" id="ini-map">
        <div class="space">
            <img src="{{ asset('../images/assets_spacecraft/Spacecraft' . $count . '.png') }}" id="spacecraft" alt="">
        </div>
        {{-- <img src="{{ asset('../images/assets_gedung/awan-1.png') }}" id="awan-1" alt="">
        <img src="{{ asset('../images/assets_gedung/awan-3.png') }}" id="awan-3" alt="">
        <img src="{{ asset('../images/assets_gedung/awan-5.png') }}" id="awan-5" alt=""> --}}
        {{-- <img src="{{ asset('../images/assets_gedung/bird.png') }}" id="bird-1" alt=""> --}}
        <h1 class="title-depan" style="z-index:5">Engineering Tour</h1>
        <div class="container-fluid my-0 my-4">
            <div class="row my-5">
                <div class="col  d-flex justify-content-center">

                    <div class="map-container">
                        <img src="{{ asset('../images/assets_gedung/map_rgb_cropped.png') }}" class="map_image"
                            alt="">
                        @if (!array_search(1, $pos))
                            <img src="{{ asset('../images/assets_gedung/bw/TA_bw.png') }}" alt="" class="point"
                                id="ta-bw">
                        @endif
                        @if (!array_search(2, $pos))
                            <img src="{{ asset('../images/assets_gedung/bw/TB_bw.png') }}" alt="" class="point"
                                id="tb-bw">
                        @endif
                        @if (!array_search(3, $pos))
                            <img src="{{ asset('../images/assets_gedung/bw/TC_bw.png') }}" alt="" class="point"
                                id="tc-bw">
                        @endif
                        @if (!array_search(4, $pos))
                            <img src="{{ asset('../images/assets_gedung/bw/TD_bw.png') }}" alt="" class="point"
                                id="td-bw">
                        @endif
                        @if (!array_search(5, $pos))
                            <img src="{{ asset('../images/assets_gedung/bw/TE_bw.png') }}" alt="" class="point"
                                id="te-bw">
                        @endif
                        @if (!array_search(6, $pos))
                            <img src="{{ asset('../images/assets_gedung/bw/TF_bw.png') }}" alt="" class="point"
                                id="tf-bw">
                        @endif
                        @if (!array_search(7, $pos))
                            <img src="{{ asset('../images/assets_gedung/bw/TG_bw.png') }}" alt="" class="point"
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

            <div class="row  d-flex justify-content-center  my-4">
                <div class="col d-flex justify-content-center">
                    {{-- <div class="password-wrapper d-flex justify-content-center">
                        <div class="nes-field">
                            <label for="input-password" class="broken-console" style="color: #fff">Password: </label>
                            <input type="text" id="input-password" class="nes-input broken-console" maxlength="7">
                        </div>
                        <div class="check-section d-flex align-items-end px-3">
                            <button type="button" class="nes-btn is-primary" style="height: " onclick="checkPass()">
                                document.getElementById('dialog-question').showModal();
                                Check
                            </button>
                        </div>

                    </div> --}}
                    <!-- QR Scanner -->
                    <div class="container-qr-reader">
                        <div class="content-qr-reader">
                            <h1>Scan QR Codes</h1>
                            <div class="section-qr-reader">
                                <div id="my-qr-reader">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End QR Scanner -->
                </div>

            </div>

            <dialog class="nes-dialog is-rounded" id="dialog-question">
                {{-- <form method="dialog"> --}}
                <p class="title" id="titles">Ini Judul</p>
                <!-- Question 1 -->
                <p id="quest-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Delectus, soluta eaque? Vero quis aut voluptate. Architecto sequi tempore quos, 
                    dolore delectus ipsa unde vel voluptates voluptatem dolor? Corrupti, magni expedita.</p>
                <input type="radio" name="options-1" id="option1-1" value="">
                <label for="option1-1" id="labelOption1-1">option1</label><br>
                <input type="radio" name="options-1" id="option1-2" value="">
                <label for="option1-2" id="labelOption1-2">option2</label><br>
                <input type="radio" name="options-1" id="option1-3" value="">
                <label for="option1-3" id="labelOption1-3">option3</label><br>
                <input type="radio" name="options-1" id="option1-4" value="">
                <label for="option1-4" id="labelOption1-4">option4</label><br>

                <!-- Question 2 -->
                <p id="quest-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Delectus, soluta eaque? Vero quis aut voluptate. Architecto sequi tempore quos, 
                    dolore delectus ipsa unde vel voluptates voluptatem dolor? Corrupti, magni expedita.</p>
                <input type="radio" name="options-2" id="option2-1" value="">
                <label for="option2-1" id="labelOption2-1">option1</label><br>
                <input type="radio" name="options-2" id="option2-2" value="">
                <label for="option2-2" id="labelOption2-2">option2</label><br>
                <input type="radio" name="options-2" id="option2-3" value="">
                <label for="option2-3" id="labelOption2-3">option3</label><br>
                <input type="radio" name="options-2" id="option2-4" value="">
                <label for="option2-4" id="labelOption2-4">option4</label><br>

                <!-- Question 3 -->
                <p id="quest-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Delectus, soluta eaque? Vero quis aut voluptate. Architecto sequi tempore quos, 
                    dolore delectus ipsa unde vel voluptates voluptatem dolor? Corrupti, magni expedita.</p>
                <input type="radio" name="options-3" id="option3-1" value="">
                <label for="option3-1" id="labelOption3-1">option1</label><br>
                <input type="radio" name="options-3" id="option3-2" value="">
                <label for="option3-2" id="labelOption3-2">option2</label><br>
                <input type="radio" name="options-3" id="option3-3" value="">
                <label for="option3-3" id="labelOption3-3">option3</label><br>
                <input type="radio" name="options-3" id="option3-4" value="">
                <label for="option3-4" id="labelOption3-4">option4</label><br>

                <!-- Question 4 -->
                <p id="quest-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Delectus, soluta eaque? Vero quis aut voluptate. Architecto sequi tempore quos, 
                    dolore delectus ipsa unde vel voluptates voluptatem dolor? Corrupti, magni expedita.</p>
                <input type="radio" name="options-4" id="option4-1" value="">
                <label for="option4-1" id="labelOption4-1">option1</label><br>
                <input type="radio" name="options-4" id="option4-2" value="">
                <label for="option4-2" id="labelOption4-2">option2</label><br>
                <input type="radio" name="options-4" id="option4-3" value="">
                <label for="option4-3" id="labelOption4-3">option3</label><br>
                <input type="radio" name="options-4" id="option4-4" value="">
                <label for="option4-4" id="labelOption4-4">option4</label><br>

                <!-- Question 5 -->
                <p id="quest-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Delectus, soluta eaque? Vero quis aut voluptate. Architecto sequi tempore quos, 
                    dolore delectus ipsa unde vel voluptates voluptatem dolor? Corrupti, magni expedita.</p>
                <input type="radio" name="options-5" id="option5-1" value="">
                <label for="option5-1" id="labelOption5-1">option1</label><br>
                <input type="radio" name="options-5" id="option5-2" value="">
                <label for="option5-2" id="labelOption5-2">option2</label><br>
                <input type="radio" name="options-5" id="option5-3" value="">
                <label for="option5-3" id="labelOption5-3">option3</label><br>
                <input type="radio" name="options-5" id="option5-4" value="">
                <label for="option5-4" id="labelOption5-4">option4</label><br>

                <!-- Question 6 -->
                <p id="quest-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Delectus, soluta eaque? Vero quis aut voluptate. Architecto sequi tempore quos, 
                    dolore delectus ipsa unde vel voluptates voluptatem dolor? Corrupti, magni expedita.</p>
                <input type="radio" name="options-6" id="option6-1" value="">
                <label for="option6-1" id="labelOption6-1">option1</label><br>
                <input type="radio" name="options-6" id="option6-2" value="">
                <label for="option6-2" id="labelOption6-2">option2</label><br>
                <input type="radio" name="options-6" id="option6-3" value="">
                <label for="option6-3" id="labelOption6-3">option3</label><br>
                <input type="radio" name="options-6" id="option6-4" value="">
                <label for="option6-4" id="labelOption6-4">option4</label><br>

                <!-- Question 7 -->
                <p id="quest-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, 
                    soluta eaque? Vero quis aut voluptate. Architecto sequi tempore quos, 
                    dolore delectus ipsa unde vel voluptates voluptatem dolor? Corrupti, magni expedita.</p>
                <input type="radio" name="options-7" id="option7-1" value="">
                <label for="option7-1" id="labelOption7-1">option1</label><br>
                <input type="radio" name="options-7" id="option7-2" value="">
                <label for="option7-2" id="labelOption7-2">option2</label><br>
                <input type="radio" name="options-7" id="option7-3" value="">
                <label for="option7-3" id="labelOption7-3">option3</label><br>
                <input type="radio" name="options-7" id="option7-4" value="">
                <label for="option7-4" id="labelOption7-4">option4</label><br>

                
                <div class="dialog-menu">
                    <div class="back-next">
                        <button class="nes-btn hidden" id="back" onclick="back()">Back</button>
                        <button class="nes-btn" id="next" onclick="next()">Next</button>
                    </div>
                    <div class="confirm-section">
                        <button class="nes-btn is-primary hidden" id="confirm" onclick="submit()">Confirm</button>
                    </div>

                </div>
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
    <script type="text/javascript">

        $(window).on('load', function() {
            count = {{ $count }}

            if (count == 7) {
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

        const closeModal1 = () => {
            document.getElementById('modal_congrats').close()
        }

        const checkPass = () => {
            let pass = $('#input-password').val().toUpperCase()
            $.ajax({
                type: 'POST',
                url: '{{ route('check.pass') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'pass': pass,
                },
                success: function(data) {
                    if (data.msg == "GET") {
                        current = 0
                        pos = data.pos
                        alert("You are in " + pos)
                        console.log(data)
                        document.getElementById('dialog-question').showModal()
                        $('#titles').text(pos + " (" + (current + 1) + ")")
                        console.log(data.questions)
                        questions = data.questions[0]
                        console.log(questions[current])

                        $('#quest').text(questions[current]['question'])
                        $('#answer').focus()

                    } else if (data.msg == "INVALID") {
                        $('#input-password').val("")
                        $('#input-password').focus()
                        alert("Sorry, you already finished this section")
                    } else {
                        alert("Oops, wrong password")
                        $('#input-password').val("")
                        $('#input-password').focus()
                    }
                }
            })
        }

        const next = () => {
            // $('#answer').focus()
            
            answers[current] = $('input[name="option"]:checked').val()

            console.log(answers[current])
            current += 1
            $('#answer').val(answers[current])
            $('#titles').text(pos + " (" + (current + 1) + ")")
            $('#quest').text(questions[current]['question'])

            if (current == questions.length - 1) {
                $('#next').addClass("hidden")
                $('#confirm').removeClass("hidden")
            }

            if (current == 0) {
                $('#back').addClass("hidden")
            } else {
                $('#back').removeClass("hidden")
            }

        }

        const back = () => {
            $('#answer').focus()
            answers[current] = $('#answer').val()
            current -= 1
            $('#answer').val(answers[current])
            $('#titles').text(pos + " (" + (current + 1) + ")")
            $('#quest').text(questions[current]['question'])

            if (current != (questions.length)) {
                $('#next').removeClass("hidden")
                $('#confirm').addClass("hidden")
            }

            if (current == 0) {
                $('#back').addClass("hidden")
            } else {
                $('#back').removeClass("hidden")
            }

        }

        const submit = () => {
            if (!confirm("Are you sure?")) return

            answers[current] = $('#answer').val()

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
    </script>
{{--    <script src="https://unpkg.com/html5-qrcode"></script>--}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
{{--    <script src="{{ asset('js/qr-reader.js') }}"></script>--}}
    <script>
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "my-qr-reader", { fps: 10, qrbox: 250 }, false);

        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            // console.log(`Scan result: ${decodedText}`, decodedResult);
            // let url = `/qr-scanner/detail/${decodedText}`;
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
                        console.log(data)
                        document.getElementById('dialog-question').showModal()
                        $('#titles').text(pos + " (" + (current + 1) + ")")
                        console.log(data.questions)
                        questions = data.questions[0]
                        console.log(questions[current])

                        questions.forEach( function(index, question){
                            current = index+1
                            idQuest = '#quest'+current
                            console.log(idQuest)
                            $(idQuest).text(questions[current]['question'])

                            labelOption1 = '#labelOption'+current+'-1'
                            option1 = '#option'+current+'-1'
                            $(labelOption1).text(questions[current]['option'][0]['option_text'])
                            $('#option1').val(questions[current]['option'][0]['option_text'])

                            labelOption2 = '#labelOption'+current+'-2'
                            option2 = '#option'+current+'-2'
                            $('#labelOption2').text(questions[current]['option'][1]['option_text'])
                            $('#option2').val(questions[current]['option'][1]['option_text'])

                            labelOption3 = '#labelOption'+current+'-3'
                            option3 = '#option'+current+'-3'
                            $('#labelOption3').text(questions[current]['option'][2]['option_text'])
                            $('#option3').val(questions[current]['option'][2]['option_text'])

                            labelOption4 = '#labelOption'+current+'-4'
                            option4 = '#option'+current+'-4'
                            $('#labelOption4').text(questions[current]['option'][3]['option_text'])
                            $('#option4').val(questions[current]['option'][3]['option_text'])
                        });
                       
                        // $('#answer').focus()
                    } else if (data.msg == "INVALID") {
                        $('#input-password').val("")
                        $('#input-password').focus()
                        alert("Sorry, you already finished this section")
                    } else {
                        alert("Oops, wrong password")
                        $('#input-password').val("")
                        $('#input-password').focus()
                    }
                },
                error: function(xhr) {
                console.log(xhr);
              }
            })

            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        // function onScanError(errorMessage) {
        //     // handle on error condition, with error message
        //     console.log(errorMessage)
        // }

        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection
