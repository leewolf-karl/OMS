
<script>
    var myVar = setInterval(function(){ myTimer() }, 1000);

    function myTimer(second) {
        
        var d = new Date();
        var t = d.toLocaleTimeString();
        var today = d.toLocaleDateString();
        document.getElementById("today_date").innerHTML = today + " " + t;
    }
    
</script>


<div id="wrapper">
<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#" style='font-size:23px;'><img src='../icon/logo.png' height = '40px'><span style='position:relative;top:-20px;left:50px;'>Outsourcing Management System</span></a>
				</div>
				<br><br>

                <span id = "today_date" style = "font-size:25px;color:white;" class = "pull-right">--- ---</span>

				<hr>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style = 'margin-left:9%;'>
                    <ul class="nav navbar-nav side-nav1">
                        <li><a href="#" class = "borders"><img src= '../icon/dashboard.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
                        <li class = "active"><a href="../maintenance/manageModule.php" class = "borders"><img src= '../icon/maintenance.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Maintenance</a></li>
                        <li><a href="../transactions/transaction.php" class = "borders"><img src= '../icon/transaction.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Transaction</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/query.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Queries</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/report.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Reports</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/utility.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Utilities</a></li>
                        <li><a href="../login/logout.php?type=<?php echo $_SESSION['accType'];?>" class = "borders"><img src= '../icon/logout.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Log out</a></li>
                    </ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" style = 'top:21.5%;'>
                    <li>
                        <a href="manageModule.php" id = "style"><i class="fa fa-fw fa-envelope-o"></i> Module</a>
                    </li>
                    <li>
                        <a href="manageRole.php" id = "style"><i class="fa fa-fw fa-user-md"></i> User Role</a>
                    </li>
                    <li>
                        <a href="manageEducAttain.php" id = "style"><i class="fa fa-fw fa-graduation-cap"></i> Educational Attainment</a>
                    </li>
                    <li>
                        <a href="manageCertification.php" id = "style"><i class="fa fa-fw fa-paperclip"></i> Certificate</a>
                    </li>
                    <li>
                        <a href="manageAdmin.php" id = "style"><i class="glyphicon glyphicon-user"></i> User Admin</a>
                    </li>
                    <li>
                        <a href="manageNature.php" id = "style"><i class="fa fa-fw fa-pinterest"></i> Nature of Business</a>
                    </li>
                    <li>
                        <a href="manageCategory.php" id = "style"><i class="glyphicon glyphicon-th-list"></i> Category</a>
                    </li>
                    <li>
                        <a href="manageCourse.php" id = "style"><i class="fa fa-fw fa-book"></i> Course</a>
                    </li>
                    <li>
                        <a href="manageSkill.php" id = "style"><i class="glyphicon glyphicon-equalizer"></i> Skill</a>
                    </li>
                    <li>
                        <a href="manageQualification.php" id = "style"><i class="fa fa-fw fa-copy"></i> Qualification</a>
                    </li>
                    <li>
                        <a href="manageRequirement.php" id = "style"><i class="fa fa-fw fa-paste"></i> Requirement</a>
                    </li>
                    <li>
                        <a href="manageJob.php" id = "style"><i class="fa fa-fw fa-list-alt"></i> Job Title</a>
                    </li>
                    <li>
                        <a href="manageBenefit.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Benefit</a>
                    </li>
                    <li>
                        <a href="manageSpecialization.php" id = "style"><i class="fa fa-fw fa-universal-access"></i> Specialization</a>
                    </li>
                </ul>
			</div>
		</nav>