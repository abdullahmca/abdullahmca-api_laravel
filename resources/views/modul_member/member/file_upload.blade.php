<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"><meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Bootstrap 5 Progress Bar Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5" style="max-width: 900px">
         
        <div class="alert alert-primary mb-4 text-center">
           <h2 class="display-6">Laravel File Upload with Ajax Progress Bar Example - ItSolutionStuff.com</h2>
        </div>  
        <form id="fileUploadForm" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data"> 
    {{ csrf_field() }}
            <div class="form-group mb-3">
                <input name="file" id="file" type="file" class="form-control">
            </div>
            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
            <div class="d-grid mt-4">
                <input type="submit" id="btnSimpanx" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    
<script type="text/javascript">
$("#btnSubmit").click(function(){
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $.ajax({
        type: "POST",
        url: " {{ url('/modul_member/member/login') }}",
        data: {
            email: "emailku@gmail.com",
        },
        success: function(response){
           
           console.log(response);
        }
    });
});
$("#btnSimpan").click(function(){
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});  var form_data = new FormData(document.getElementById("fileUploadForm"));
    $.ajax({
        type: "POST",
        url: " {{ url('upload/member') }}",
        data: {
            data: form_data, 
        },
        success: function(response){
           
           console.log(response);
        }
    });
});
        // $(function () {
        //     $(document).ready(function () {
        //         $('#fileUploadForm').ajaxForm({
        //             beforeSend: function () {
        //                 var percentage = '0';
        //             },
        //             uploadProgress: function (event, position, total, percentComplete) {
        //                 var percentage = percentComplete;
        //                 $('.progress .progress-bar').css("width", percentage+'%', function() {
        //                   return $(this).attr("aria-valuenow", percentage) + "%";
        //                 })
        //             },
        //             complete: function (xhr) {
        //                 console.log('File has uploaded');
        //             }
        //         });
        //     });
        // });
    </script>
</body>
</html>