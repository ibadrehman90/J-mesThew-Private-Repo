$(document).ready(function() {
	$('#tip-section').hide();
	$('#contip-section').hide();
	$('#editprofile').hide();
	$('#addrecp').hide();
	$('#addtip').hide();
	$('#addcontest').hide();
	$('#dltemsg').hide();
	$("#recipe-section").load('tst.php');
	$("#showcondata").load('conadd.php');
	
});



function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#eimg').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	
function readURLprofile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#pimg').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
}

function readconURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#coneimg').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
}

function showrcipedata()
{
	$("#recipe-section").load('tst.php');
}

function showcontestdata()
{
	$("#showcondata").load('conadd.php');
}

function editdata($id)
{
	$("#editrecp").load('editrecptip.php', {'ripid': $id});
	$("#editrecp").show();
	$('#addrecp').hide();	
	$('#addtip').hide();
}

function edittipdata($id)
{
	$("#edittip").load('edittip.php', {'tipid': $id});
	$("#edittip").show();
	$('#addrecp').hide();	
	$('#addtip').hide();
}

function editmemtipdata($id)
{
	$("#editmemtip").load('editmemtip.php', {'tipid': $id});
	$("#editmemtip").show();
	$('#ownparttip').hide();
}

function editcondata($id)
{
	$("#editcontest").load('editcon.php', {'cipid': $id});
	$("#editcontest").show();
	$('#addcontest').hide();	
}

function editmemrecpdata($id)
{
	$("#editmemrecp").load('editmemrecp.php', {'ripid': $id});
	$("#editmemrecp").show();
	$('#ownpartrecipe').hide();	
}

function showrecp()
{
	$('#recipe-section').show();
	$('#tip-section').hide();
	$('#recipemenu').addClass('act');
	$('#tipsmenu').removeClass('act');
	
	$('#conrecipe-section').show();
	$('#contip-section').hide();
	$('#recipemenu').addClass('act');
	$('#tipsmenu').removeClass('act');	
}

function showtip()
{
	$('#recipe-section').hide();
	$('#tip-section').show();
	$('#recipemenu').removeClass('act');
	$('#tipsmenu').addClass('act');
	
	$('#conrecipe-section').hide();
	$('#contip-section').show();
	$('#recipemenu').removeClass('act');
	$('#tipsmenu').addClass('act');
}

$add_ing_var = 1;

function adding()
{
	$add_ing_var = $add_ing_var + 1;
	
$('#ingredients').append("<input class='form-control space-sm' name='ing" + $add_ing_var + "' id='ing" + $add_ing_var +"' type='text' placeholder='Add Ingredient # " + $add_ing_var + "'>");
}

function reming()
{
	if($add_ing_var > 1)
	{
		$add_ing_var = $add_ing_var - 1;
		
		$('#ingredients input:text:last').remove();
	}
}

$add_dir_var = 1;

function adddir()
{
	$add_dir_var = $add_dir_var + 1;
	
$('#directions-form').append("<textarea class='form-control space-sm' name='dir" + $add_dir_var + "' id='dir" + $add_dir_var +"' placeholder='Add Direction # " + $add_dir_var + "'></textarea>");
}

function remdir()
{
	if($add_dir_var > 1)
	{
		$add_dir_var = $add_dir_var - 1;
		
		$('#directions-form textarea:last').remove();
	}
}

$add_field_var = 1;

function addfield()
{
	$add_field_var = $add_field_var + 1;
	
$('#fields-form').append("<textarea class='form-control space-sm' name='field" + $add_field_var + "' id='field" + $add_field_var +"' placeholder='Add Field # " + $add_field_var + "'></textarea>");
}

function remfield()
{
	if($add_field_var > 1)
	{
		$add_field_var = $add_field_var - 1;
		
		$('#fields-form textarea:last').remove();
	}
}

function editprofile()
{
	$('#viewprofile').hide();
	$('#editprofile').show();
}

function viewprofile()
{
	$('#viewprofile').show();
	$('#editprofile').hide();
}

function addrecp()
{
	$('#addrecp').show();
	$('#addtip').hide();
	$('#editrecp').hide();	
	$('#edittip').hide();
}

function addtip()
{
	$('#addrecp').hide();
	$('#addtip').show();
	$('#editrecp').hide();	
	$('#edittip').hide();
}

function dlteid($nme,$str)
{ 
	if($nme == 1)
	{
		$a = $('#dltemsg p').text();
		$('#dltemsg p').text($a + " recipe?");		
    	$('#dltid').val("recp_id = '" + $str + "'");
	}
	else if($nme == 2)
	{
		$a = $('#dltemsg p').text();
		$('#dltemsg p').text($a + " tip?");
		$('#dltid').val("tip_id = '" + $str + "'");
	}
	$('#dltemsg').show();

}

function dltememid($nme,$str,$id)
{ 
	if($nme == 1)
	{
		$a = $('#dltemsg p').text();
		$('#dltemsg p').text($a + " recipe?");		
    	$('#dltid').val("cd_id = '" + $str + "'");
	}
	else if($nme == 2)
	{
		$a = $('#dltemsg p').text();
		$('#dltemsg p').text($a + " tip?");
		$('#dltid').val("cd_id = '" + $str + "'");
	}
	$('#sendconid').val($id);
	
	$('#dltemsg').show();

}

function dltecon($str)
{ 
		
   	$('#dltid').val("con_id = '" + $str + "'");

	$('#dltemsg').show();

}

function msgnoti()
{
  $('#notif').hide();
}

function addeing()
{
	$edit_ing_var = $edit_ing_var + 1;
	
$('#editingredients').append("<input class='form-control space-sm' name='ing" + $edit_ing_var + "' id='ing" + $edit_ing_var +"' type='text' placeholder='Add Ingredient # " + $edit_ing_var + "'>");
}

function remeing()
{
	if($edit_ing_var > 1)
	{
		$edit_ing_var = $edit_ing_var - 1;
		
		$('#editingredients input:text:last').remove();
	}
}

function addedir()
{
	$edit_dir_var = $edit_dir_var + 1;
	
$('#editdirections-form').append("<textarea class='form-control space-sm' name='dir" + $edit_dir_var + "' id='dir" + $edit_dir_var +"' placeholder='Add Direction # " + $edit_dir_var + "'></textarea>");
}

function remedir()
{
	if($edit_dir_var > 1)
	{
		$edit_dir_var = $edit_dir_var - 1;
		
		$('#editdirections-form textarea:last').remove();
	}
}

function addefield()
{
	$edit_thing_var = $edit_thing_var + 1;
	
$('#editfields-form').append("<textarea class='form-control space-sm' name='field" + $edit_thing_var + "' id='field" + $edit_thing_var +"' placeholder='Add Field # " + $edit_thing_var + "'></textarea>");
}

function remefield()
{
	if($edit_thing_var > 1)
	{
		$edit_thing_var = $edit_thing_var - 1;
		
		$('#editfields-form textarea:last').remove();
	}
}


//members fields

function addcing()
{
	$edit_cing_var = $edit_cing_var + 1;
	
$('#editmemingredients').append("<input class='form-control space-sm' name='cing" + $edit_cing_var + "' id='cing" + $edit_cing_var +"' type='text' placeholder='Add Ingredient # " + $edit_cing_var + "'>");
}

function remcing()
{
	if($edit_cing_var > 1)
	{
		$edit_cing_var = $edit_cing_var - 1;
		
		$('#editmemingredients input:text:last').remove();
	}
}

function addcdir()
{
	$edit_cdir_var = $edit_cdir_var + 1;
	
$('#editmemdirections-form').append("<textarea class='form-control space-sm' name='cdir" + $edit_cdir_var + "' id='cdir" + $edit_cdir_var +"' placeholder='Add Direction # " + $edit_cdir_var + "'></textarea>");
}

function remcdir()
{
	if($edit_cdir_var > 1)
	{
		$edit_cdir_var = $edit_cdir_var - 1;
		
		$('#editmemdirections-form textarea:last').remove();
	}
}

function winnerannounce()
{
	
	var vtr = $('#myonoffswitch').prop('checked');
	var id = $('#winnid').val();
	var conid = $('#winnconid').val();
	
		$.ajax({
            type: 'post',
            url: 'linkdb.php',
            data: {winarr : vtr , winid : id, winconid : conid},
            success: function (data) {
              alert("The Winner is selected!");
            }
          });
}

