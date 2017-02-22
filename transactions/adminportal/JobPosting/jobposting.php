<?php
	include("../../../php/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		
	</head>

	<body>

		<?php
		include "nav_admin.php";
   
		?>
        <div id="page-wrapper" class = "fright">

            <div class="container-fluid" id = "data">
            <br>
                <h3 class = "clientext">Post Job and Open for Job Offerings:</h3>
                
<div class="row">
<div class="col-lg-3">
                <select id = "nature" name= "for" class = "form-control clientext" style = "float: left; margin-right: 10px; margin-top: 10px">
							<option class = "form-control" selected disabled>Nature of Business</option>
							<?php
								$query = "SELECT * from business_nature WHERE Status = 0";
								$exec = mysql_query($query);
								if(!$exec)
								{
									echo "Error in department ";
									die (print_r(mysql_error(), true));
								}
								while ($row = mysql_fetch_array($exec))
								{
									$did = $row['BusinessNatureID'];
									$dname = $row['Description'];

									echo "<option value = $did>$dname</option>";
								}
							?>
						</select>	
</div>
  <div class="col-lg-3">
                <select id = "dep" name= "for" class = "form-control clientext" style = " float: left; margin-right: 10px; margin-top: 10px">
							<option class = "form-control" selected disabled>Department</option>
							
						</select>	
</div>
<div class="col-lg-3">
               			
						<select id = "job" class = "form-control clientext" style = "margin-top: 10px; float: left; margin-right: 5%;">
							<option class = "form-control">*Choose Department First</option>
						</select>
</div>
<div class="col-lg-2">
                <input type="number" name="" class="form-control" placeholder="No. of Openings">
</div>
</div>

  <div class="row">
    <div class="col-lg-12">
      <fieldset>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
      </fieldset>
    </div>
  </div>
<br>
<h3>Current Job Openings</h3>
<div class="row">

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>
</div>

<div class="row">

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>

 <div class="col-lg-3">
    <div class="hovereffect">
        <fieldset>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </fieldset>
        <div class="overlay">
           <h2>Applicants: 69</h2>
           <div class="row">
            <div class="col-lg-4">
              <a class="info" href="#">show</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">hide</a>
            </div>
            <div class="col-lg-4">
              <a class="info" href="#">delete</a>
            </div>
           </div>
        </div>
    </div>
</div>
</div>

  <div class="row">
    <center>
      <button type="submit" class="btn btn-default">Proceed</button>
      <button type="reset" class="btn btn-default">Clear</button>
    </center>
  </div> 
  </div>
  </div>
  <script>
		$("#nature").change(function() {
	  	$("#dep").load("getdeplist.php?b=" + $("#nature").val());
			});
			
		$("#dep").change(function() {
	  	$("#job").load("getjoblist.php?d=" + $("#dep").val());
			});
  </script>
       </body>
       <style>
.hovereffect {
width:100%;
height:100%;
float:left;
overflow:hidden;
position:relative;
text-align:center;
cursor:default;
}

.hovereffect .overlay {
width:100%;
height:100%;
position:absolute;
overflow:hidden;
top:0;
left:0;
opacity:0;
background-color:rgba(0,0,0,0.5);
-webkit-transition:all .4s ease-in-out;
transition:all .4s ease-in-out
}

.hovereffect fieldset {
display:block;
position:relative;
-webkit-transition:all .4s linear;
transition:all .4s linear;
}

.hovereffect h2 {
text-transform:uppercase;
color:#fff;
text-align:center;
position:relative;
font-size:17px;
background:rgba(0,0,0,0.6);
-webkit-transform:translatey(-100px);
-ms-transform:translatey(-100px);
transform:translatey(-100px);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
padding:10px;
}

.hovereffect a.info {
text-decoration:none;
display:inline-block;
text-transform:uppercase;
color:#fff;
border:1px solid #fff;
background-color:transparent;
opacity:0;
filter:alpha(opacity=0);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
padding: 2% 2%;
}

.hovereffect a.info:hover {
box-shadow:0 0 5px #fff;
}

.hovereffect:hover fieldset {
-ms-transform:scale(1.2);
-webkit-transform:scale(1.2);
transform:scale(1.2);
}

.hovereffect:hover .overlay {
opacity:1;
filter:alpha(opacity=100);
}

.hovereffect:hover h2,.hovereffect:hover a.info {
opacity:1;
filter:alpha(opacity=100);
-ms-transform:translatey(0);
-webkit-transform:translatey(0);
transform:translatey(0);
}

.hovereffect:hover a.info {
-webkit-transition-delay:.2s;
transition-delay:.2s;
}
       </style>
</html>