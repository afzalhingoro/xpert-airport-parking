
$('#contactform').on('submit',function(e){    
	e.preventDefault();    
	var form = $(this).serialize();    
	$.ajax({        
		url: "contact-us-submit",        
		type:"POST",        
		data:form,        
		success:function(response){            
			$('#contactpagesuccessMsg').show();            
			console.log(response);            
			document.getElementById("contactform").reset();        
		    },    
	    
	   });
});
