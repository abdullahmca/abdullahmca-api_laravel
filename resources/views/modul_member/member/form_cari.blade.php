<meta name="csrf-token" content="{{ csrf_token() }}" />
<form class="form">
	{{ csrf_field() }}
	<label>
		email
	</label>
	<label>
		<input type="email" name="email" id="email" value="">
	</label>
	<label>
		Password
	</label>
	<label>
		<input type="password" name="password" id="password" value="">
	</label> 
	<label>
		<input type="button" id="btnSubmit" name="submit" value="cari">
		<input type="button" id="btnSimpan" name="submit" value="simapan_data">
	</label>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> <script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
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
});
    $.ajax({
        type: "POST",
        url: " {{ url('/modul_member/user/add') }}",
        data: {
        	email: $('#email').val(),
        	password: $('#password').val(),
        },
        success: function(response){
           
           console.log(response);
        }
    });
});
</script>