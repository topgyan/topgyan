# topgyan
project should be finish in december
<?
include('constants.php');
include('chk_session.php');
date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['title']) && ($_POST['title'] != '')){
	$sql_duplicate = "SELECT * FROM magazine WHERE mtitle = '".$_REQUEST['title']."'";
	$res_duplicate = q($sql_duplicate);
	$count = nr($res_duplicate);
	if($count == 0){
	 $file = $_FILES['profilepic'];
	 $allowextensions = array( "jpg","png","JPG","JPEG","jpeg","PNG","gif","GIF");
	 function isAllowedExtension($file){
	  global $allowextensions;
	  return in_array(end(explode(".",$file)),$allowextensions);
	 } 
	 if($file['error'] == UPLOAD_ERR_OK){
	 if(isAllowedExtension($file['name'])){
		 $target_path = "profilepic/";
		 $uploadfile = time()."_".$_FILES['profilepic']['name'];
		 $target = $target_path .$uploadfile;
		 if(move_uploaded_file($_FILES['profilepic']['tmp_name'],$target)){
		   $sql = "INSERT into magazine (mtitle,publisher,frequency,month,category,sub_category,language,territory,status,gallery,profilepic,description,addedon) VALUES ('".addslashes($_REQUEST['title'])."', '".addslashes($_REQUEST['publisher'])."', '".addslashes($_REQUEST['frequency'])."', '".addslashes($_REQUEST['month'])."','".addslashes($_REQUEST['category'])."','".addslashes($_REQUEST['sub_category'])."','".addslashes($_REQUEST['language'])."','".addslashes($_REQUEST['territory'])."','".addslashes($_REQUEST['status'])."','".addslashes($_REQUEST['gallery'])."','".$uploadfile."','".addslashes($_REQUEST['description'])."','".date('Y-m-d H:i:s')."')";
		    $res_sql =q($sql);
			if($res_sql){
			$msg = '<div class="alert alert-success"><strong>Success!</strong>-Magazine Added Successfully.</div>';
			}else{
				$msg = '<div class="alert alert-danger"><strong>Failed!</strong>-Magazine Not Added Successfully.</div>';
			}
		 }else{
			$msg='- Magazine Picture Not uploaded. Please try again.';
		}
	 }else{
				$msg='- Invalid File. Please upload only Gif, Png, Jpg, Jpeg.';
			}
 }else{
	  $admin = "INSERT into magazine (mtitle,publisher,frequency,month,category,sub_category,language,territory,status,gallery,description,addedon) VALUES ('".addslashes($_REQUEST['title'])."', '".addslashes($_REQUEST['publisher'])."', '".addslashes($_REQUEST['frequency'])."', '".addslashes($_REQUEST['month'])."','".addslashes($_REQUEST['category'])."','".addslashes($_REQUEST['sub_category'])."','".addslashes($_REQUEST['language'])."','".addslashes($_REQUEST['territory'])."','".addslashes($_REQUEST['status'])."','".addslashes($_REQUEST['gallery'])."','".addslashes($_REQUEST['description'])."','".date('Y-m-d H:i:s')."')";
		    $res_sql =q($admin);
			if($res_sql){
			$msg = '<div class="alert alert-success"><strong>Success!</strong>-Magazine Added Successfully.</div>';
			}else{
				$msg = '<div class="alert alert-danger"><strong>Failed!</strong>-Magazine Not Added Successfully.</div>';
			}
	}
}else{$msg = '<div class="alert alert-danger"><strong>Duplicate!</strong>-Magazine Already Exist.</div>';}
}


?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8" />
<title>Add Magazine | TECHMAG CRM Version 1.0</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<?
include('head.php');
?>
<script>
	function getcity(){
		var atv =  document.getElementById('ncroffice').value;
		if(atv == 1 || atv == 2 || atv == 3){
			document.getElementById('branch').style.display  = '';
		}else{
			document.getElementById('branch').style.display  = 'none';
		}
	}

	function changeText(){
		var atv =  document.getElementById('territory').value;
		if(atv == 'India'){
			document.getElementById('lc').innerHTML  = 'City <span style="color:red">*</span>';
		}else if(atv == 'Non-India'){
			document.getElementById('lc').innerHTML  = 'Country <span style="color:red">*</span>';
		}
	}
</script>
<script>
function showHint(strs) {
    if (strs.length == 0) { 
        document.getElementById("txtSerach").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtSerach").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "search.php?q=" + strs, true);
        xmlhttp.send();
    }
}
</script>
<script>
function showPunt(strp) {
    if (strp.length == 0) { 
        document.getElementById("txtPub").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtPub").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "publis.php?p="+ strp, true);
        xmlhttp.send();
    }
}
</script>
<script>
 function showUser(str)
{
if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
} 

if (window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","sub.php?id="+str,true);
xmlhttp.send();
}
</script>
<script>
 function freqUser(strq)
{
if (strq=="")
{
document.getElementById("txtFint").innerHTML="";
return;
} 

if (window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("txtFint").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","frequency.php?id="+strq,true);
xmlhttp.send();
}
</script>
	

<script>
function validate(){

	var errText = "";
	var errorflag = false;
		

	if(document.publisherform.title.value == ""){
		 errText += "- Please Enter Magazine Title.\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.title.focus();
		 return false;
	}

		if(document.publisherform.publisher.value == ""){
		 errText += "- Please Select Magazine publisher.\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.publisher.focus();
		 return false;
	}

	if(document.publisherform.frequency.value == ""){
		 errText += "- Please Select Magazine frequency .\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.frequency.focus();
		 return false;
	}
	
	
	if(document.publisherform.category.value == ""){
		 errText += "- Please Select Magazine Category\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.category.focus();
		 return false;
	}
	
	if(document.publisherform.language.value == ""){
		 errText += "- Please Select Magazine language\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.language.focus();
		 return false;
	}
	if(document.publisherform.territory.value == ""){
		 errText += "- Please Select Magazine territory\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.territory.focus();
		 return false;
	}
	if(document.publisherform.status.value == ""){
		 errText += "- Please Select Magazine status\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.status.focus();
		 return false;
	}
	if(document.publisherform.gallery.value == ""){
		 errText += "- Please Select Magazine Gallery\n";
		 alert(errText);
		 errorflag = true;
		 document.publisherform.gallery.focus();
		 return false;
	}
	

	if(errorflag==true){
		return false;
	}else{
		return true;
	}
 }
 
</script>

<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo" onload="changeText()">
        <!-- BEGIN HEADER -->
        <?
		include('header.php');
		?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <?
						include('sidebar.php');
					?>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="dashboard.php">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
						 <li>
                            Magazines
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Add Magazine</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                   <i class="icon-equalizer font-red-sunglo"></i>
													<span class="caption-subject font-red-sunglo bold uppercase" >Add Magazine</span>
													
                                                </div>
                                                <div class="tools">
                                                   <div class="btn-group btn-group-devided" data-toggle="buttons">
													 <a href="publisher-list.php" onclick="javascript:document.location.href='magazine-list.php'" class="btn btn-sm blue"><i class="fa fa-list"></i> Magazine List</a>
												</div>
                                                </div>
                                            </div>
											<div class="portlet-body form">
                                                <!-- BEGIN FORM-->                                                
												<span style="color:green;"><?=$msg;?></span>
                                                
                                                <form action="" method="POST" name="publisherform" id="publisherform" class="horizontal-form" onSubmit ="return validate();" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                        <h3 class="form-section" style="color: #3598dc">Magazine Information</h3>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <!--<div class="form-group">
                                                                    <label class="control-label">Magazine Title</label>
																	 <input type="text" name="title" id="title"  class="form-control " onkeyup="showHint(this.value)" onChange="showPunt(this.value)"> 
																	 <p><span id="txtSerach"></span></p>              
																</div>-->
																<div class="form-group ">
                                                                    <label class="control-label">Magazine Title <!-- <span style="color:red">*</span> --></label>
																   <select class="form-control" name="title" id="title" onChange="showPunt(this.value)">
																   <option  value="" > Select Magazine Title</option>
																		<?
																		$q=$_GET["p"];
																			 $tit = '';
																		    $checkMag = "select mtitle from magazine order by mgid desc";
																		   $chm = q($checkMag);
																		   $chtitle = f($chm);
																			
																		    
																		   $sql = "select concat(title,tech_title,dir_title,pr_title) as title3 from publication_title where title != '' OR tech_title != '' OR dir_title != '' OR pr_title != '' and title = '".$tit."' and tech_title = '".$tit."' and dir_title = '".$tit."' and pr_title = '".$tit."'";

																		$result = q($sql);
																		$count = nr($result);
																
																		while($row = f($result))
																		{
																		?>
																		<option value="<?=$row['title3']?>" ><?=$row['title3']?></option>
																		<? } ?>
																	</select>
                                                                    <!-- <span class="help-block" style="color: #e7505a"> Select Frequency...  </span> -->
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6" id="txtPub">
                                                              <div class="form-group">
                                                                    <label class="control-label">Publisher</label>
																	
                                                                    <input type="text" name="publisher"  class="form-control" disabled> 
																	
                                                                    <!-- <span class="help-block" style="color: #e7505a"> Publisher for this Magazine</span> -->
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group ">
                                                                    <label class="control-label">Frequency <!-- <span style="color:red">*</span> --></label>
																   <select class="form-control" name="frequency" id="frequency" onChange="freqUser(this.value)">
																   <option  value="other" > Select Frequency</option>
																		<?
																		$freq = "SELECT * from frequency";
																		$freqs = q($freq);
																		while($freqrow = f($freqs)){
																		?>
																		<option  value="<?=$freqrow['fld_id']?>" ><?=$freqrow['frequency']?></option>
																		<? } ?>
																	</select>
                                                                    <!-- <span class="help-block" style="color: #e7505a"> Select Frequency...  </span> -->
                                                                </div>
                                                            </div>
                                                            <!--/span-->
															<div class="col-md-6" id="txtFint" >
                                                            
																<div class="form-group ">
                                                                    <label class="control-label" id="lc">Issue Month Sequence <!-- <span style="color:red">*</span> --></label>
																   <select class="form-control" name ="month" disabled>
																		
																	</select>
                                                                </div>
                                                            </div>
															
                                                            <!--/span-->
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Category</label>
                                                                     <select class="form-control" id="category" name="category" onChange="showUser(this.value)"> 
																	  <option value="" style = "display:none" >Select...</option>
																	  <?
																	  $qry = "select * from mag_category";
																	  $res =q($qry);
																	  while($row = f($res)){
																		  // $id = $row['id']; -->

																	 ?>
																		<option value="<?=$row['id'] ?>"><?=$row['cat_name'] ?></option>
																		<!-- <option label="Technical" value="2">Technical </option> -->
																		<? } ?>
																	</select>
                                                                </div>
                                                            </div>
															 
                                                            <!--/span-->
                                                            <div class="col-md-6" id="txtHint" >
                                                                  <div class="form-group" >
                                                                    <label class="control-label">Sub Category <!-- <span style="color:red">*</span> --> </label>
                                                                    <select class="form-control" id="sub_category" name="sub_category" disabled></select>                              
                                                                 </div>
                                                            </div> 
                                                            <!--/span-->
                                                        </div>
														<div class="row">
                                                              <div class="col-md-6" id="branch" >
                                                                <div class="form-group">
                                                                    <label class="control-label">Language</label>
                                                                     <select class="form-control" name ="language">
																		<option label="" value="" >Select...</option>
																		<option label="English" value="English">English</option>
																		<option label="Hindi" value="Hindi">Hindi</option>
																	</select>
                                                                </div>
                                                            </div>
															 
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                 <div class="form-group">
                                                                    <label class="control-label">Country <!-- <span style="color:red">*</span> --></label>
																	<select class="form-control" name="territory">
																		<option label="" value="" >Please Select Country Name</option>
																		<?
																		$countryin = "select * from anlp_country order by fld_id desc limit 0,1";
																		$cdaaIn = q($countryin);
																		$Inres = f($cdaaIn);?>
																		<option label="India" value="<?=$Inres['country_name']?>"><?=$Inres['country_name']?></option>
																		<?
																		$country = "select * from anlp_country where country_name != 'India' order by fld_id asc";
																		$cdaa = q($country);
																		while($cores = f($cdaa)){
																		?>
																		<option value="<?=$cores['country_name']?>"><?=$cores['country_name']?></option>
																		<?}?>
																	</select>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>
														<div class="row">
                                                              <div class="col-md-6" id="branch" >
                                                                <div class="form-group">
                                                                    <label class="control-label">Display Status on Website</label>
                                                                     <select class="form-control" name="status">
																		<option label="" value="" >Select...</option>
																		<option label="Show" value="Show">Show</option>
																		<option label="Hide" value="Hide">Hide</option>
																	</select>
                                                                </div>
                                                            </div>
															 
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                 <div class="form-group">
                                                                    <label class="control-label">Select Gallery Option on Home Page <!-- <span style="color:red">*</span> --></label>
																	<select class="form-control" name="gallery">
																		<option label="" value="" >Select...</option>
																		<option label="Flagship Publication" value="Flagship Publication">Flagship Publication</option>
																		<option label="B2B Gallery" value="B2B Gallery">B2B Gallery</option>
																		<option label="Special Interest Magazine" value="Special Interest Magazine">Special Interest Magazine</option>
																		<option label="Institution Magazine" value="Institution Magazine">Institution Magazine</option>
																	</select>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>

													<h3 class="form-section" style="color: #3598dc">Other Information</h3>
													<div class="row">
														<div class="col-md-12">
															 <div class="form-group">
																<label class="control-label">Attach Cover Image<!-- <span style="color:red">*</span> --></label>
																<input type="file"  class="form-control" name="profilepic" id="profilepic"/>
																
															</div>
														</div>
													</div>
													
													<div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="form-group">
                                                                    <label>Special Note (If Any)</label>
                                                                   <textarea rows="5" cols="100" name="description" class="form-control"></textarea> </div>
                                                            </div>
                                                        </div>
													

                                                    <div class="form-actions right">
                                                        <button type="submit" class="btn blue">
                                                            <i class="fa fa-check"></i> Save Magazine</button>
															<button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
								
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <?
				include('quick-sidebar.php');
			?>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?
			include('footer.php');
		?>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>
