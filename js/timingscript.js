$(document).ready(function() {
	
	setInterval(function(){get_timeleft();}, 1000);
	
});

function get_timeleft()
{
		
	$.ajax({
            type: 'post',
            url: 'gettime.php',
            data: {tme:'sad'},
            success: function (result) {
			  
			 $res = result.substr(1,result.length - 2);
			 $a = $res.split(',');
			
			 for($i = 0; $i < $a.length; $i++)
			 {
				
				 $('#timer'+$i).text($a[$i].substr(1,$a[$i].length - 2));
				 
				 if($a[$i].substr(1,$a[$i].length - 2) == "00:00:00" )
				 {
					 settimeleft();
					
				 }
			 }  
            }
          });
}

function settimeleft()
{

	$.ajax({
            type: 'post',
            url: 'settime.php',
            data: {tme:'sad'},
            success: function (result) {
		
            }
          });
}