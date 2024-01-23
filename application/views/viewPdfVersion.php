<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.6/purify.min.js" integrity="sha512-H+rglffZ6f5gF7UJgvH4Naa+fGCgjrHKMgoFOGmcPTRwR6oILo5R+gtzNrpDp7iMV3udbymBVjkeZGNz1Em4rQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- <script src="<?php echo base_url() ?>assets/tinymce/js/tinymce/tinymce.min.js"></script> -->
	<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/plugins/lite/lite-interface.js"></script>
	<script src="<?php echo base_url() ?>assets/js/html2canvas.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jspdf.js" defer></script>
	<script src="<?php echo base_url() ?>assets/js/pdfVersionData.js" defer></script>
</head>
<body>
<style>
  .tox-promotion {
    display: none !important;
  }
  .tox-statusbar__branding {
    display: none !important;
  }
</style>
	<?php $this->load->view('sidemenu'); ?>
	<input type="hidden" value="<?php echo $pdfId ?>" id="pdfId"/>
	<a onclick="history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
	<div class="row">
		<div class="col-lg-12">
			<label>Agreement Title</label><input type="text" class="form-control" placeholder="Enter Agreement Title" id="agreement_title" disabled/>
		</div>
		<div class="col-lg-7">
			<label>Agreement Content</label><textarea id="content"></textarea>
		</div>
		<div class="col-lg-5">
			<label></label><iframe id="showPDF" width="450" height="400"></iframe>
		</div>
		
		<div class="col-lg-7" style="text-align: end; display:none;">
			<input type="button" class="btn btn-info" value="Update PDF" id="generatePdf" onclick="preparePdf();"/>
		</div>
		<div class="col-lg-12">
			<legend>Dynamic Fields</legend>
			<div class="row" id="dynamicFields" style="background-color: azure; border: 1px solid lightgray; border-radius: 6px;"></div>
		</div>
		
		<!-- <div class="col-lg-12 text-center" style="display:none;" id="copyMain">
			<input type="button" value="Copy In Main" class="btn btn-success" onclick="mapWithMain();"/>
		</div> -->
	</div>
  </div>
</div>

</body>
</html>




