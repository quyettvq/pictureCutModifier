<!DOCTYPE html>
<html>
<head>
<title>Picture Cut Modifier</title>
<!-- Dependencies -->
<script src="dependencies/jquery.min.js"></script>        
<script src="dependencies/jquery-ui.min.js"></script>
<link href="dependencies/bootstrap.min.css" rel="stylesheet">
<script src="dependencies/bootstrap.min.js"></script>
<!-- Picture cut -->
<script src="picture.cut/src/jquery.picture.cut.js"></script>  
<!-- Modifier -->
<link href="modifier/style.min.css" rel="stylesheet">
<script src="modifier/mod.js"></script>  
</head>
<body>

<div class="PictureCutImageContainer">
</div>
<script>
$(".PictureCutImageContainer").each(function(){
	var PictureCutImageContainer = $(this);
	var InputName = PictureCutImageContainer.siblings("input").attr("id");
	PictureCutImageContainer.PictureCut({
		Extensions                  : ["jpg","jpeg","png","gif"],
		InputOfImageDirectory       : InputName,
		PluginFolderOnServer        : "<?= str_replace('//', '/', $_SERVER['REQUEST_URI'] . '/picture.cut/') ?>",
		FolderOnServer              : "<?= str_replace('//', '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', __DIR__)) . '/uploads/') ?>",
		EnableCrop                  : true,
		CropWindowStyle             : "Bootstrap",
		ImageNameRandom             : false,
		MinimumWidthToResize        : 4096,
		MinimumHeightToResize       : 4096,
		MaximumSize                 : 4096,
		EnableMaximumSize           : false,
		UploadedCallback            : function(data){
			PictureCutImageContainer.siblings("input").val(data["currentFileName"]);
		}
	});
});
	
pictureCutModifier.initCropMode([
	{"value" : 9/16, "label" : "9 x 16"},
	{"value" : 3/4, "label" : "3 x 4"},
	{"value" : 4/3, "label" : "4 x 3"},
	{"value" : 16/9, "label" : "16 x 9"}
]);

</script>
</body>
</html>