<script>
$(document).ready(function() {
$('#butsave').on('click', function() {
$("#butsave").attr("disabled", "disabled");
var fname = $('#fname').val();
var lname = $('#lname').val();
var email = $('#email').val();
var contno = $('#contactno').val();
var ppic = $('#profilepic').val();
var add = $('#address').val();
console.log(fname);
if(fname!="" && lname!="" && email!="" && contno!="" && ppic!="" && add!=""){
	$.ajax({
		url: "insert.php",
		type: "POST",
		data: {
			fname: fname,
            lname: lname,
			email: email,
			contno: contactno,
			ppic: profilepic,
            add: address			
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$("#butsave").removeAttr("disabled");
				$('#fupForm').find('input:text').val('');
				$("#success").show();
				$('#success').html('Data added successfully !'); 						
			}
			else if(dataResult.statusCode==201){
				alert("Error occured !");
			}
			
		}
	});
	}
	else{
		alert('Please fill all the field !');
	}
})
});
</script>