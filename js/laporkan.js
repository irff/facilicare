$(function(){
	$("#pilih-foto").click(function(){$("#berkas").click();});
	$("#berkas").change(function(){
		//
	});
	$("#kirim").click(function(){
		//$("#form-laporan").submit();
		$("#kirim").hide();
		$.post("pengolah.php", {berkas:$("#berkas").val()}, function(data, st, xr){
			if( st == "success" )
			{
			}else alert("Maaf, pesan gagal dikirim -_-");
			$("#kirim").show();
		});
	});

	var options = {
	    beforeSend: function()
	    {
	        $("#progress").show();
	        //clear everything
	        $("#bar").width('0%');
	        $("#message").html("");
	        $("#percent").html("0%");
	    },
	    uploadProgress: function(event, position, total, percentComplete)
	    {
	        $("#bar").width(percentComplete+'%');
	        $("#percent").html(percentComplete+'%');
	 
	    },
	    success: function()
	    {
	        $("#bar").width('100%');
	        $("#percent").html('100%');
	 
	    },
	    complete: function(response)
	    {
	        //$("#message").html("<font color='green'>"+response.responseText+"</font>");
	    },
	    error: function()
	    {
	        //$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
	 		$("#bar").style.color = "red";
	    }
	};

	$("#form-laporan").ajaxForm(options);

});