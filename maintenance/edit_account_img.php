<?php
  if( (isset($_POST['editid']) and isset($_POST['editimgloc'])) and isset($_POST['editimgfname']) ){
   
     
?>
<script>
	$(function(){
			

			$("#edit_am_img").fileinput({
               
                  uploadUrl: "upload.php",
                  uploadExtraData: {amid: <?php echo $_POST['editid'];?>},
                  allowedFileExtensions: ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG"],
                  removeFromPreviewOnError: true,
                  showUpload: false,
                  minFileCount: 1,
                  maxFileCount: 1,
                  resizeImage: true,
                  overwriteInitial: true,
                  dropZoneTitle: 'Drag and Drop Image here &hellip;',
                  initialPreviewAsData: true,
                  initialPreview: [ "<?php echo $_POST['editimgloc'];?>" ],
				          initialPreviewConfig: [ {caption: "<?php echo $_POST['editimgfname'];?>" } ]

              }).on('fileuploaded', function(event, data, previewId, index){
                   $('#edit_am_img_status').val(data.response.initialPreview);

              });
	});

</script>

		<input id="edit_am_img" name='upload_name[]' multiple type="file"  accept="image/*" data-preview-file-type="text">
		
<?php	
}
?>