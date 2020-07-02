<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/fa/all.css') }}" rel="stylesheet"> <!--load all styles -->

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md mb-0" style="font-size:8vw;">
                    <img class="img-fluid" src="imgs/logo.png" alt="logo"><br>
                    xPL-printserver <span class="badge badge-success" style="font-size:12px;">ready</span>
                </div>
                <button type="button" class="btn btn-sm btn-primary mb-4" data-toggle="modal" data-target="#exampleModalLong2"><i class="fas fa-print"></i> print test</button>
                <button type="button" class="btn btn-sm btn-primary mb-4" data-toggle="modal" data-target="#exampleModalLong1"><i class="fas fa-upload"></i> upload template</button>
                <button type="button" class="btn btn-sm btn-primary mb-4" data-toggle="modal" data-target="#exampleModalLong"><i class="fas fa-list"></i> show templates</button><br>
                <div class="links">
                    <a href="https://github.com/achauque/xPL-printclient" target="_blanck"><i class="fab fa-github-square"></i>xPL-printclient</a>
                    <a href="https://www.linkedin.com/in/esteban-alejandro-chauque-7a0a3b35/" target="_blanck"><i class="fab fa-linkedin"></i>Profile</a>
                    <a href="https://github.com/achauque?tab=repositories"><i class="fab fa-github-square"></i>Projects</a>
                </div>
            </div>

        </div>
        
        <!-- Modal Templates-->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Show Templates</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                        $path_template = env('PATH_TEMPLATES', 'templates');
                        // Sort in ascending order - this is default
                        $a = scandir($path_template);
        
                        // Sort in descending order
                        $b = scandir($path_template,1);
                        @endphp
                        <table>
                        @foreach ($b as $item)
                            @if($item != '..' && $item != '.')
                                <tr>
                                    <td> 

                                        <form method="POST" action="{{ route('delete.template') }}" role="form" enctype="multipart/form-data">
                                            @csrf
                                            <input name="zpl_file" type="text" value="{{$item}}" hidden>
                                            <button type="submit" class="btn btn-sm btn-danger" @if($item == 'test.xpl') {{"disabled"}} @endif>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td> <a href="{{ env('PATH_TEMPLATES', 'templates').'/'.$item }}" target="_BLANCK" type="button" class="btn btn-sm btn-info"><i class="fas fa-search"></i></a> </td>
                                    <td> {{$item}} </td>
                                </tr>
                            @endif
                        @endforeach
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Upload Templates-->
        <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle1">Upload Template</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('upload.template') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile03" name="zpl_file" required>
                                    <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Print Test Templates-->
        <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle2">Print Test Template</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="control-group text-center" >
                            <img class="img-fluid" src="imgs/test.png" alt="test">
                            <input id="ip_address" class="form-control" placeholder="IP ADDRESS">
                            <input id="port" class="form-control" placeholder="PORT">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="print_test()">print</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="message" class="alert alert-success alert-dismissible fade show fixed-bottom w-25 p-3" role="alert" style="display:none;">
            <strong><i class="fa fa-check-circle-o text-success" aria-hidden="true"></i> Upload success</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    </body>
    <script>
        $( document ).ready(function() {
            console.log( "ready!" );

            @if (session('success'))
                $('#message').show();
                setTimeout(function() { 
                    $('#message').fadeOut(1000); 
                }, 2000);
            @endif

        });
        function print_test(){
            console.log( "send!" );

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var objHeader = {
                'Authorization': 'Bearer ' + CSRF_TOKEN,
                'X-CSRF-TOKEN': CSRF_TOKEN
            };

            var json_data = {
                "template" : "test.xpl",
                "printer" : $('#ip_address').val(),
                "port" : $('#port').val(),
                "parms" : [
                    "GUANACO",
                    "12345678"
                    ]
            };

            console.log(json_data);

            $.ajax({
                url: '/api/print',
                type: 'POST',
                data: JSON.stringify(json_data),
                async: false,
                contentType: 'application/json; charset=utf-8',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true
                },
                headers : objHeader,
                success: function(response){
                    console.log(response);
                },
                error: function(e){
                    console.log('error');
                }
            });

        }
    </script>
</html>