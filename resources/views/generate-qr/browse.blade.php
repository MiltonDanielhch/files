@extends('voyager::master')

@section('page_title', 'Generar QR')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">
                    <i class="fa fa-qrcode"></i> Generar QR
                </h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <form action="" method="post" id="form-submit">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="text">Texto</label>
                                <div class="input-group">
                                    <input type="text" name="text" id="input-text" class="form-control" placeholder="Ingrese el texto" required>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary" type="button" style="margin: 0px">
                                            <span class="fa fa-cloud-download" aria-hidden="true"></span> Search!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row" id="qr-content" style="display: none">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body text-center">
                        <div id="canvas"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script src="{{ asset('vendor/qr-code/qr-code-styling.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form-submit').submit(function(e){
                e.preventDefault();
                $('#canvas').empty();
                $('#qr-content').fadeIn();
                let logo = "{{ setting('system.logo-qr') ? asset('storage').'/'.str_replace('\\', '/', setting('system.logo-qr')) : '' }}";
                const qrCode = new QRCodeStyling({
                    width: 300,
                    height: 300,
                    type: "png",
                    data: $('#input-text').val(),
                    image: logo,
                    dotsOptions: {
                        // color: "#2575e1",
                        type: "rounded"
                    },
                    backgroundOptions: {
                        color: "#ffffff",
                    },
                    imageOptions: {
                        crossOrigin: "anonymous",
                        margin: 10
                    }
                });

                qrCode.append(document.getElementById("canvas"));
                qrCode.download({ name: $('#input-text').val(), extension: "png" });
            });
        });
    </script>
@stop
