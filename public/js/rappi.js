$(document).ready(function(){
        $("#runner").click(function() {
            var input_file=$("#theInput").val();
            var token=$('input[name="_token"]').val();
            $.post( "/api",{ user_input:input_file,_token:token})
            	.done(function (data){
            		var output=[];
            		for (i=0;i<data.length;i++)
            			output.push(data[i]);
            		$("#theOutput").val(output.join("\n"));
            	});
        });
});