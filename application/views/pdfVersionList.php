<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!--Data Table-->
    <script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/pdfVersionList.js" defer></script>
</head>
<body>
<div class="container-fluid">
	<?php $this->load->view('sidemenu'); ?>
	<input type="hidden" value="<?php echo $pdfId ?>" id="pdfId" />
	<a onclick="history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
	<div class="row">
		<div class="table">
			<table class="table table-hover" id="searchTable">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Agreement Title</th>
						<th>Owner</th>
						<th>Comment</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="table table-hover" id="search_table_data"></tbody>
			</table>
			</div>
		</div>
	</div>
</body>
</html>
