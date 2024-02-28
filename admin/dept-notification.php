<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin| Closed Complaints</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <body>

        <?php include('include/header.php'); ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include('include/sidebar.php'); ?>
                    <div class="span9">
                        <div class="content">

                            <div class="module">
                                <div class="module-head">
                                    <h3>notification</h3>
                                </div>
                                <div class="module-body table">



                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th style="text-align: center">Complaint Number</th>
                                                <th style="text-align: center">Reg Date</th>
                                                <th style="text-align: center">last Updation date</th>
                                                <th style="text-align: center">Status</th>
                                                <th style="text-align: center">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $query = mysqli_query($con, "select * from tblcomplaints where userId='" . $_SESSION['id'] . "'");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td align="center"><?php echo htmlentities($row['complaintNumber']); ?></td>
                                                    <td align="center"><?php echo htmlentities($row['regDate']); ?></td>
                                                    <td align="center"><?php echo  htmlentities($row['lastUpdationDate']);

                                                                        ?></td>
                                                    <td align="center"><?php
                                                                        $status = $row['status'];
                                                                        if ($status == "" or $status == "NULL") { ?>
                                                            <button type="button" class="btn btn-danger">Not Process Yet</button>
                                                        <?php }
                                                                        if ($status == "in process") { ?>
                                                            <button type="button" class="btn btn-warning">In Process</button>
                                                        <?php }
                                                                        if ($status == "closed") {
                                                        ?>
                                                            <button type="button" class="btn btn-success">Closed</button>
                                                        <?php } ?>
                                                    <td align="center">
                                                        <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>">
                                                            <button type="button" class="btn btn-primary">view Report</button></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div><!--/.content-->
                        </div><!--/.span9-->
                    </div>
                </div><!--/.container-->
            </div><!--/.wrapper-->

            <?php include('include/footer.php'); ?>

            <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
            <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
            <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
            <script src="scripts/datatables/jquery.dataTables.js"></script>
            <script>
                $(document).ready(function() {
                    $('.datatable-1').dataTable();
                    $('.dataTables_paginate').addClass("btn-group datatable-pagination");
                    $('.dataTables_paginate > a').wrapInner('<span />');
                    $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
                    $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
                });
            </script>


    </body>

    </html>
<?php } ?>