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

<div class="PicturecutImageContainer">
</div>
<script>
$(".PicturecutImageContainer").each(function(){
	var PicturecutImageContainer = $(this);
	var InputName = PicturecutImageContainer.siblings("input").attr("id");
	PicturecutImageContainer.PictureCut({
		Extensions                  : ["jpg","jpeg","png","gif"],
		InputOfImageDirectory       : InputName,
		PluginFolderOnServer        : "<?= rtrim($_SERVER['REQUEST_URI'], '/') ?>/picture.cut/",
		FolderOnServer              : "<?= str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', __DIR__)) ?>/uploads/",
		EnableCrop                  : true,
		CropWindowStyle             : "Bootstrap",
		ImageNameRandom             : false,
		MinimumWidthToResize        : 4096,
		MinimumHeightToResize       : 4096,
		MaximumSize                 : 4096,
		EnableMaximumSize           : false,
		UploadedCallback            : function(data){
			PicturecutImageContainer.siblings("input").val(data["currentFileName"]);
			textCount(PicturecutImageContainer.siblings("input"), false);
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