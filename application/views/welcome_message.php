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
	<script src="<?php echo base_url() ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/html2canvas.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jspdf.js" defer></script>
	<script src="<?php echo base_url() ?>assets/js/convertPdf.js" defer></script>
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
<div class="container-fluid">
<div class="row">
	<div class="col-lg-7">
	<textarea id="content"><p><strong>Creating an agreement for student Acknowledgement</strong></p>

<p>This Student Acknowledgement Agreement (&quot;Agreement&quot;) is made and entered into on {date_of_agreement} by and between {institute_name}, with its principal address at {institute_address} (hereinafter referred to as the &quot;Institution&quot;), and the undersigned student, {student_name}, with a primary address at {student_address} (hereinafter referred to as the &quot;Student&quot;).</p>

<p>&nbsp;</p>

<p><strong>1. STUDENT INFORMATION:</strong></p>

<p>1.1 Student Name: {student_name}</p>

<p>1.2 Student ID: {student_id}</p>

<p>1.3 Program of Study: {program_of_study}</p>

<p>1.4 Expected Graduation Date: {expected_graduation_date}</p>

<p>&nbsp;</p>

<p><strong>2. PROGRAM DETAILS:</strong></p>

<p>2.1 Course Name: {course_name}</p>

<p>2.2 Course Start Date: {course_start_date}</p>

<p>2.3 Course End Date: {course_end_date}<br />
&nbsp;</p>

<p><strong>3. FINANCIAL RESPONSIBILITIES:</strong></p>

<p>3.1 Tuition and Fees: The Student acknowledges the financial obligations, including tuition and fees, associated with the enrolled program.</p>

<p>3.2 Payment Schedule: The Student agrees to adhere to the payment schedule outlined by the Institution.</p>

<p>&nbsp;</p>

<p><strong>4. CODE OF CONDUCT:</strong></p>

<p>4.1 The Student agrees to comply with the Institution&#39;s code of conduct, academic policies, and all relevant rules and regulations.</p>

<p>&nbsp;</p>

<p><strong>5. ACADEMIC RESPONSIBILITIES:</strong></p>

<p>5.1 The Student acknowledges the academic responsibilities, including attendance requirements, completion of assignments, and adherence to academic integrity policies.</p>

<p>&nbsp;</p>

<p><strong>6. CONFIDENTIALITY:</strong></p>

<p>6.1 The Student agrees to maintain the confidentiality of any non-public information obtained during their enrollment at the Institution.</p>

<p>&nbsp;</p>

<p><strong>7. PERSONAL INFORMATION:</strong></p>

<p>7.1 The Student confirms that all personal information provided to the Institution is accurate and up-to-date.</p>

<p>&nbsp;</p>

<p><strong>8. DISCLAIMERS:</strong></p>

<p>8.1 The Institution reserves the right to modify programs, schedules, and policies as necessary.</p>

<p>8.2 The Student acknowledges that any changes to personal contact information must be promptly communicated to the Institution.</p>

<p>&nbsp;</p>

<p><strong>9. ACKNOWLEDGEMENT:</strong></p>

<p>9.1 By signing this Agreement, the Student acknowledges that they have read, understood, and agree to abide by the terms and conditions outlined herein.</p>

<p>&nbsp;</p>

<p>IN WITNESS WHEREOF, the parties hereto have executed this Student Acknowledgement Agreement as of the Effective Date.</p>

<p>How our application works</p>

<p>Step 1 : Either upload word file or create using our text editor</p>

<p>Step 2 : Add dynamic fields</p>

<p>e.g Student Name, type (number/alphanumeric),description(about the filed) &nbsp;(we save it student_name),</p>

<p>Step 3: After completing the agreement all dynamic field defined at the time of agreement creation will added to excel</p>

<p>Step 4 : Preview of agreement will be generated</p>
</div></textarea>
	</div>
	
	<div class="col-lg-5">
		<iframe id="showPDF" width="550" height="400"></iframe>
	</div>
	<div class="col-lg-7" style="text-align: end;">
		<input type="button" class="btn btn-info" value="Update PDF" id="generatePdf" onclick="preparePdf();"/>
	</div>
	<div class="col-lg-5" style="text-align: end;">
		<input type="button" class="btn btn-success" value="Download Excel" onclick="exportExcelData();"/>
	</div>
	<div class="col-lg-12">
		<legend>Dynamic Fields</legend>
  		<div class="row" id="dynamicFields" style="background-color: azure; border: 1px solid lightgray; border-radius: 6px;"></div>
	</div>
	
</div>
</div>

</body>
</html>




