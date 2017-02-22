<!DOCTYPE html>
<html lang="en">
	<head>

	</head>

	<body>

		<?php include("nav_client.php");
		?>

		<div class="container-fluid"  style = "padding-top: 70px; padding-left: 310px;">
            <h3>SHORTLIST</h3>
            <br>

            <div class="panel panel-default">
			  <div class="panel-heading">APPLICANT SHORTLIST</div>
			  <div class="panel-body">
			    
			    <!--Applicant Shortlist Section-->
			    <div class="col-md-6" style = "border-right: 1px solid #ccc;">
			    	<div class="form-horizontal">
			    		<label class="col-md-2">Show entries:</label>
                        <select class="input-sm col-md-2" />
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                        </select>

                        <label class="col-md-1 control-label">Job:</label>
                        <select class="input-sm col-md-3" />
                            <option>Job 1</option>
                            <option>Job 2</option>
                            <option>Job 3</option>
                            <option>Job 4</option>
                        </select>

                        <br><br>
                        <button type="button" class="btn btn-default pull-right">&nbsp;&nbsp;&nbsp;Hire&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
                    </div>
                    <br><br>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Position Applying</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>


                        </tbody>

                    </table>
                    <div class="pull-right">
                        <nav aria-label="Page navigation">
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>
			    </div>

			    <!--Hired Shortlist Panel-->
			    <div class="col-md-6">
			    	<div class="form-horizontal">
                        <label class="col-md-2">Show entries:</label>
                        <select class="input-sm col-md-2" />
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                        </select>
                        <br><br>
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Remove</button>
                            <button type="button" class="btn btn-success">Send to Agency</button>
                        </div>
                    </div>
                    <br><br>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Position Applying</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tbody>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>Zhai</th>
                                <th>20</th>
                                <th>Male</th>
                                <th>CEO</th>
                                <th>
                                    <span>
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="View Resume"><span class="glyphicon glyphicon-file"></span></button>
                                    </span>
                                </th>
                            </tr>


                        </tbody>
                        </tbody>

                    </table>
                    <div class="pull-right">
                        <nav aria-label="Page navigation">
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>
			    </div>


			  </div>
			</div>

            

            </div>
        </div>

	</body>

</html>
