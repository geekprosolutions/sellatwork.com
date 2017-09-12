<?php
include "backpages/connection.php" ;
include "backpages/timeago.php";
if(!isset($_SESSION['session_web']['valid']) || $_SESSION['session_web']['valid']!=true  )
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait... ";
	die;
}
elseif(!isset($_SESSION['session_web']['login_userVerified']) || $_SESSION['session_web']['login_userVerified']!="Verified" || !isset($_SESSION['session_web']['login_userCompanyVerified']) || $_SESSION['session_web']['login_userCompanyVerified']!="Verified")
{	
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Please Verify Your Account. Redirecting Please Wait...";
	die;
}

if(!isset($_SESSION['session_web']['last_product_id']) || strlen(trim($_SESSION['session_web']['last_product_id']))==0)
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Redirecting Please Wait...";
	die;
}
else
{
	$pro_id=$_SESSION['session_web']['last_product_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Online Shopping </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="SellAtWork,SAW, trusted classifieds, safe, buy from co-workers, selling to peers, social shopping, online deals, classifieds, Buy local stuff, Local stuff for sale, Local shopping, Local marketplace, Local yard sales, Local garage sales, Sell locally, Buy locally, Sell stuff at Work, trusted network, no worry buy and sell" />

 
<!-- Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
<link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider --> 
<link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->  
<!-- web-fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- web-fonts --> 
<!-- js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


<!-- Image P{lugin Scripts -->

<link rel="icon" type="image/png" href="favicon.ico">
<!-- //js --> 
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!--range slider-->
<link rel="stylesheet" href="css/jquery_ui.css">
<script src="js/range_slider/jquery_ui.js"></script>


<!-- **************************** Alertify **************************** -->
<script src="js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="css/alertify/alertify.min.css"/>
<!-- **************************** Alertify Ends **************************** -->
<!-- **************************** Image Plugin **************************** -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.0/cropper.min.css">
<link rel="stylesheet" href="imagePlugin/assets/css/demo.css">
<link rel="stylesheet" href="imagePlugin/assets/css/fileicons.css">
<link rel="stylesheet" href="imagePlugin/assets/css/filepicker.css">
<!-- **************************** Image Plugin Ends **************************** -->
</head>
<body style="background-color:#F5F5F5;">
<div id="My_conatiner">
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->	
	<div id="Add_products">	
		  <div class="top_header">
		  <?php 
				$sql=mysqli_query($conn,"select * from products where product_id='".$pro_id."' and user_id='".$_SESSION['session_web']['login_userId']."' ") or die (mysqli_error($conn));
				$fetch=mysqli_fetch_array($sql);
				$title=$fetch['title'];
				$category=$fetch['category'];
				$upload_on=$fetch['upload_on'];
				?>
				<h2>Add Photos For The Product </h2>
				<a href="index.php"> << Home </a>
		  </div>
		  <div class="clear"></div>
			<div class="add_photo_information">
			<?php echo "<div class='col-lg-5 pd_leftq'><div class='add_head'><span>Product Title :</span> $title </div> </div>
			<div class='col-lg-3 pd_leftq'><div class='add_head'><span>Category :</span> $category </div> </div>
			<div class='col-lg-4 pd_leftq'><div class='add_head'><span>Uploaded On : </span>".get_timeago(strtotime($upload_on)) ." </div> 
			</div>";?> 
			</div> 		
			<div class="demo-container col-md-10 col-md-offset-1">
				<div class="wraper">
					<div id="filepicker">
						<!-- Button Bar -->
						<div class="button-bar">
							<div class="btn btn-success fileinput">
								<i class="fa fa-arrow-circle-o-up"></i> Upload
								<input type="file" name="files[]" multiple>
							</div>

							<button type="button" class="btn btn-primary camera-show">
								<i class="fa fa-camera"></i> Camera
							</button>

							<button type="button" class="btn btn-danger delete-all">
								<i class="fa fa-trash-o"></i> Delete all
							</button>
							
							<a href="ReviewAd/<?php echo $pro_id ;?>"><button type="button" class="btn btn-info ">
								<i class="fa fa-eye"></i> View Add
							</button></a>
						</div>

						<!-- Files -->
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="column-preview">Preview</th>
										<th class="column-name">Name</th>
										<th class="column-size">Size</th>
										<th class="column-date">Modified</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody class="files"></tbody>
								<tfoot><tr><td colspan="5">No files were found.</td></tr></tfoot>
							</table>
						</div>

						<!-- Pagination -->
						<div class="pagination-container text-center"></div>

						<!-- Drop Window -->
						<div class="drop-window">
							<div class="drop-window-content">
								<h3><i class="fa fa-upload"></i> Drop files to upload</h3>
							</div>
						</div>
					</div><!-- end of #filepicker -->
			</div>
			</div>
		</div>	
	</div>
	 <!-- Crop Modal -->
    <div id="crop-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" data-dismiss="modal">&times;</span>
                    <h4 class="modal-title">Make a selection</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning crop-loading">Loading image...</div>
                    <div class="crop-preview"></div>
                </div>
                <div class="modal-footer">
                    <div class="crop-rotate">
                        <button type="button" class="btn btn-default btn-sm crop-rotate-left" title="Rotate left">
                            <i class="fa fa-undo"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm crop-flip-horizontal" title="Flip horizontal">
                            <i class="fa fa-arrows-h"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-default btn-sm crop-flip-vertical" title="Flip vertical">
                            <i class="fa fa-arrows-v"></i>
                        </button> -->
                        <button type="button" class="btn btn-default btn-sm crop-rotate-right" title="Rotate right">
                            <i class="fa fa-repeat"></i>
                        </button>
                    </div>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success crop-save" data-loading-text="Saving...">Save</button>
                </div>
            </div>
        </div>
    </div><!-- end of #crop-modal -->

    <!-- Camera Modal -->
    <div id="camera-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" data-dismiss="modal">&times;</span>
                    <h4 class="modal-title">Take a picture</h4>
                </div>
                <div class="modal-body">
                    <div class="camera-preview"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left camera-hide" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success camera-capture">Take picture</button>
                </div>
            </div>
        </div>
    </div><!-- end of #camera-modal -->
	
	<!--  Image Plugin Scripts -->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.5.2/jquery.timeago.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.0/cropper.min.js"></script>
<script src="imagePlugin/assets/js/filepicker.js"></script>
<script src="imagePlugin/assets/js/filepicker-ui.js"></script>
<script src="imagePlugin/assets/js/filepicker-drop.js"></script>
<script src="imagePlugin/assets/js/filepicker-crop.js"></script>
<script src="imagePlugin/assets/js/filepicker-camera.js"></script>
<script>
	$.noConflict();
	jQuery(document).ready(function ($) 
	{
		var pro_id="<?php echo $pro_id ; ?>";
		$('#filepicker').filePicker({
			url: 'imagePlugin/uploader/index.php?e='+pro_id,
			plugins: ['ui', 'drop', 'camera', 'crop']
		});

		// Replace timeago strings.
		if ($.fn.timeago) {
			$.timeago.settings.strings = $.extend({}, $.timeago.settings.strings , {
				seconds: 'few seconds', minute: 'a minute',
				hour: 'an hour', hours: '%d hours', day: 'a day',
				days: '%d days', month: 'a month', year: 'a year'
			});
		}
	});
</script>

    <!-- Upload Template -->
    <script type="text/x-tmpl" id="uploadTemplate">
        <tr class="upload-template">
            <td class="column-preview">
                <div class="preview">
                    <span class="fa file-icon-{%= o.file.extension %}"></span>
                </div>
            </td>
            <td class="column-name">
                <p class="name">{%= o.file.name %}</p>
                <span class="text-danger error">{%= o.file.error || '' %}</span>
            </td>
            <td colspan="2">
                <p>{%= o.file.sizeFormatted || '' %}</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active"></div>
                </div>
            </td>
            <td>
                {% if (!o.file.autoUpload && !o.file.error) { %}
                    <a href="#" class="action action-primary start" title="Upload">
                        <i class="fa fa-arrow-circle-o-up"></i>
                    </a>
                {% } %}
                <a href="#" class="action action-warning cancel" title="Cancel">
                    <i class="fa fa-ban"></i>
                </a>
            </td>
        </tr>
    </script><!-- end of #uploadTemplate -->

    <!-- Download Template -->
    <script type="text/x-tmpl" id="downloadTemplate">
        {% o.timestamp = function (src) {
            return (src += (src.indexOf('?') > -1 ? '&' : '?') + new Date().getTime());
        }; %}
        <tr class="download-template">
            <td class="column-preview">
                <div class="preview">
                    {% if (o.file.versions && o.file.versions.thumb) { %}
                        <a href="{%= o.file.url %}" target="_blank">
                            <img src="{%= o.timestamp(o.file.versions.thumb.url) %}" width="64" height="64"></a>
                        </a>
                    {% } else { %}
                        <span class="fa file-icon-{%= o.file.extension %}"></span>
                    {% } %}
                </div>
            </td>
            <td class="column-name">
                <p class="name">
                    {% if (o.file.url) { %}
                        <a href="{%= o.file.url %}" target="_blank">{%= o.file.name %}</a>
                    {% } else { %}
                        {%= o.file.name%}
                    {% } %}
                </p>
                {% if (o.file.error) { %}
                    <span class="text-danger">{%= o.file.error %}</span>
                {% } else { %}  <span class="text-danger"> Uploaded Successfully</span> {% } %}
            </td>
            <td class="column-size"><p>{%= o.file.sizeFormatted %}</p></td>
            <td class="column-date">
                {% if (o.file.time) { %}
                    <time datetime="{%= o.file.timeISOString() %}">
                        {%= o.file.timeFormatted %}
                    </time>
                {% } %}
            </td>
            <td>
                {% if (o.file.imageFile && !o.file.error) { %}
                    <a href="#" class="action action-primary crop" title="Crop">
                        <i class="fa fa-crop"></i>
                    </a>
                {% } %}
                {% if (o.file.error) { %}
                    <a href="#" class="action action-warning cancel" title="Cancel">
                        <i class="fa fa-ban"></i>
                    </a>
                {% } else { %}
                    <a href="#" class="action action-danger delete" title="Delete">
                        <i class="fa fa-trash-o"></i>
                    </a>
                {% } %}
            </td>
        </tr>
    </script><!-- end of #downloadTemplate -->

    <!-- Pagination Template -->
    <script type="text/x-tmpl" id="paginationTemplate">
        {% if (o.lastPage > 1) { %}
            <ul class="pagination pagination-sm">
                <li {% if (o.currentPage === 1) { %} class="disabled" {% } %}>
                    <a href="#!page={%= o.prevPage %}" data-page="{%= o.prevPage %}" title="Previous">&laquo;</a>
                </li>

                {% if (o.firstAdjacentPage > 1) { %}
                    <li><a href="#!page=1" data-page="1">1</a></li>
                    {% if (o.firstAdjacentPage > 2) { %}
                       <li class="disabled"><a>...</a></li>
                    {% } %}
                {% } %}

                {% for (var i = o.firstAdjacentPage; i <= o.lastAdjacentPage; i++) { %}
                    <li {% if (o.currentPage === i) { %} class="active" {% } %}>
                        <a href="#!page={%= i %}" data-page="{%= i %}">{%= i %}</a>
                    </li>
                {% } %}

                {% if (o.lastAdjacentPage < o.lastPage) { %}
                    {% if (o.lastAdjacentPage < o.lastPage - 1) { %}
                        <li class="disabled"><a>...</a></li>
                    {% } %}
                    <li><a href="#!page={%= o.lastPage %}" data-page="{%= o.lastPage %}">{%= o.lastPage %}</a></li>
                {% } %}

                <li {% if (o.currentPage === o.lastPage) { %} class="disabled" {% } %}>
                    <a href="#!page={%= o.nextPage %}" data-page="{%= o.nextPage %}" title="Next">&raquo</a>
                </li>
            </ul>
        {% } %}
    </script><!-- end of #paginationTemplate -->
	
	
</div>
<!-- Footer Begins-->
	<?php include "footer.php" ; ?>
	<!-- Footer Ends -->
<!-- Loader Begins -->
<div id="ark_loader" class="ark_loader" style="display:none" >
	<span>
		<span class="innerLdr"><img src="img/loading.gif" style="height:150px" ></span>
	</span>
</div>
<!-- Loader Ends -->
 
</body>
</html>


 
<!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->
</script>  
