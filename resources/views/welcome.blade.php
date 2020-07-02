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
                    xPL-printserver
                </div>
                <button type="button" class="btn btn-sm btn-success mb-4"><i class="fas fa-print"></i> print test</button>
                <button type="button" class="btn btn-sm btn-success mb-4" data-toggle="modal" data-target="#exampleModalLong1"><i class="fas fa-upload"></i> upload template</button>
                <button type="button" class="btn btn-sm btn-success mb-4" data-toggle="modal" data-target="#exampleModalLong"><i class="fas fa-list"></i> show templates</button><br>
                <div class="links">
                    <a href="https://github.com/achauque/xPL-printclient"><i class="fab fa-github-square"></i>xPL-printclient</a>
                    <a href="https://www.linkedin.com/in/esteban-alejandro-chauque-7a0a3b35/"><i class="fab fa-linkedin"></i>Profile</a>
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
                                    <td> <button type="button" class="btn btn-sm btn-danger" @if($item == 'test.xpl') {{"disabled"}} @endif>
                                            <i class="fas fa-trash"></i>
                                        </button>
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
    </body>
    <script>
        $( document ).ready(function() {
            console.log( "ready!" );
        });
    </script>
</html>