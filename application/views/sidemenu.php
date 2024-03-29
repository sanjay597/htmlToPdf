<style>
    /* Style the sidebar - fixed full height */
.sidebar {
  height: 100%;
  width: 220px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 16px;
}

/* Style sidebar links */
.sidebar a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}

/* Style links on mouse-over */
.sidebar a:hover {
  color: #f1f1f1;
}

/* Style the main content */
.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  padding: 0px 10px;
}

/* Add media queries for small screens (when the height of the screen is less than 450px, add a smaller padding and font-size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container-fluid">
    <input type="hidden" value="<?php echo base_url(); ?>" id="base_url"/>
    <input type="hidden" value="<?php echo $_SESSION['name'] ?>" id="adminName"/>
    <input type="hidden" value="<?php echo $_SESSION['id'] ?>" id="adminId"/>
	<div class="row mt-4">
		<div class="col-lg-2">
            <div class="sidebar">
                <a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-fw fa-home"></i> Create Agreement</a>
                <a href="<?php echo base_url('admin/pdfList') ?>"><i class="fa fa-fw fa-wrench"></i> Pdf List</a>
                <a href="<?php echo base_url('logout') ?>"><i class="fa fa-fw fa-wrench"></i> Logout</a>
            </div>
        </div>
		<div class="col-lg-10">
      <script>
        const adminName = $('#adminName').val();
        const adminId = $('#adminId').val();
      </script>
<!-- The sidebar -->


