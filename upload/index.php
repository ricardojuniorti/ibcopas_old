<html>
<head>
 <script src="..js/jquery.js"></script>
  <script type="text/javascript">
	$(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
  </script>
  <link href="upload.css" rel="stylesheet">
</head>
<div class="avatar-wrapper">
	<img class="profile-pic" src="" />
	<div class="upload-button">
		<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
	</div>
	<input class="file-upload" type="file" accept="image/*"/>
</div>
</html>