<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @php
            header('Origin: http://labelary.com/');
            header('Access-Control-Allow-Origin:*');
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Methods: GET,HEAD,PUT,PATCH,POST,DELETE');
            header('Access-Control-Allow-Headers: Authorization, X-Custom-Header');
        @endphp

        <title>xPL-printserver</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/fa/all.css') }}" rel="stylesheet"> <!--load all styles -->

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/app-guanaco.js') }}" defer></script>

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
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQVMD5AQAPM48&source=url" target="_blanck"><img src="https://img.shields.io/badge/Donate-PayPal-green.svg"/></a>
                    <a href="https://github.com/achauque/xPL-printclient" class = "btn btn-outline-dark" target="_blanck"><i class="fab fa-github-square"></i> xPL-printclient</a>
                    <a href="https://www.linkedin.com/in/esteban-alejandro-chauque-7a0a3b35/" class = "btn btn-outline-dark" target="_blanck"><i class="fab fa-linkedin"></i> Profile</a>
                    <a href="https://github.com/achauque?tab=repositories" class = "btn btn-outline-dark" target="_blanck"><i class="fab fa-github-square"></i> Projects</a>
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
                                    <td> <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModalLong3" onclick='img_show_labelary("{{ env('PATH_TEMPLATES', 'templates').'/'.$item }}");'><i class="fas fa-eye"></i></button> </td>
                                    <td> <a href="{{ env('PATH_TEMPLATES', 'templates').'/'.$item }}" target="_BLANCK" class="btn btn-sm btn-info"><i class="fas fa-download"></i></a> </td>
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

        <!-- Modal Show Templates-->
        <div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle3">Show Template power by <a href="http://labelary.com/" target="_BLANCK">http://labelary.com/</a></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-inline">
                            <input id="file_redo" name="file_redo" value="" hidden>
                            <input id="label_width" class="form-control col-sm" placeholder="width" value="2">
                            <input id="label_height" class="form-control col-sm" placeholder="height" value="2">
                            <select class="form-control" id="sizeUM">
                                <option value="1">inch</option>
                                <option value="2">cm</option>
                                <option value="3">mm</option>
                              </select>
                            <button class="btn btn btn-info" onclick='img_redo_labelary();'><i class="fas fa-redo"></i></button>
                        </div>
                        
                        <img src="" id="img_show_template_labelary" name="img_show_template_labelary" width="100%"/>
                    </div>
                    <div class="modal-footer">
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

        function img_show_labelary(path_xpl){
            console.log( "send!" );
            $("#file_redo").val(path_xpl);
            
            var txt = '';
            var xmlhttp = new XMLHttpRequest();
            
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
                    txt = xmlhttp.responseText;
                    console.log(txt);

                    $.ajax({
                        url: 'http://api.labelary.com/v1/printers/8dpmm/labels/2x2/0/',
                        type: 'POST',
                        data: txt,
                        xhrFields:{
                            responseType: 'blob'
                        },
                        success: function(response, textStatus, jqXHR){
                            const url = window.URL || window.webkitURL;
                            const src = url.createObjectURL(response);
                            $("#img_show_template_labelary").attr('src', src);                  
                        },
                        error: function(e){
                            console.log('error');
                        }
                    });

                }
            };
            xmlhttp.open("GET", path_xpl, true);
            xmlhttp.send();
        }

        function img_redo_labelary(){
            console.log( "send!" );
            var file_redo = $("#file_redo").val();

            var w = $("#label_width").val();
            var h = $("#label_height").val();
            var s = $("#sizeUM").val();
            
            console.log("size");
            console.log(s);

            if (s == 2){
                w = w / 2.54;
                h = h / 2.54;
            }

            if (s == 3){
                w = (w / 10) / 2.54;
                h = (h / 10) / 2.54;
            }

            var txt = '';
            var xmlhttp = new XMLHttpRequest();
            
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
                    txt = xmlhttp.responseText;
                    console.log(txt);

                    $.ajax({
                        url: 'http://api.labelary.com/v1/printers/8dpmm/labels/' + w + 'x' + h + '/0/',
                        type: 'POST',
                        data: txt,
                        xhrFields:{
                            responseType: 'blob'
                        },
                        success: function(response, textStatus, jqXHR){
                            const url = window.URL || window.webkitURL;
                            const src = url.createObjectURL(response);
                            $("#img_show_template_labelary").attr('src', src);                  
                        },
                        error: function(e){
                            console.log('error');
                        }
                    });

                }
            };
            xmlhttp.open("GET", file_redo, true);
            xmlhttp.send();
        }
    </script>
</html>
