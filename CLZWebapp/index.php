<html>

	<head>

	<title> Home - Philippine Collegiate Data Repository </title>

	   <link href="css/bootstrap.min.css" rel="stylesheet">	
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">



	</head>
	<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://getbootstrap.com/examples/starter-template/#">Philippine Collegiate Data Repository</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://getbootstrap.com/examples/starter-template/#">Home</a></li>
            <li><a href="http://getbootstrap.com/examples/starter-template/#about">About</a></li>
            <li><a href="http://getbootstrap.com/examples/starter-template/#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <br></br>
    <div class="container">

      <div class="jumbotron">
      <div class="container">
        <h1>Welcome to PCDR</h1>
        <p>Philippine Collegiate Data Repository (PCDR) is dedicated to providing accurate and precise data from college students all over the country</p>
        <p><a class="btn btn-primary btn-lg" href="#">Learn more »</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">


          <h2>College Students Information</h2>


          <?php
                          $host    = "localhost";
                          $user    = "root";
                          $pass    = "1234";
                          $db_name = "database_name_here";

                //create connection
                          $connection = mysqli_connect($host, $user, $pass, $db_name);

                //test if connection failed
                          if(mysqli_connect_errno()){
                            die("connection failed: "
                              . mysqli_connect_error()
                              . " (" . mysqli_connect_errno()
                              . ")");
                          }

                //get results from database
                          $result = mysqli_query($connection,"SELECT * FROM products");
                $all_property = array();  //declare an array for saving property

                //showing property
                echo '<table class="data-table">
                        <tr class="data-heading">';  //initialize table tag
                          while ($property = mysqli_fetch_field($result)) {
                    echo '<td>' . $property->name . '</td>';  //get field name for header
                    array_push($all_property, $property->name);  //save those to array
                  }
                echo '</tr>'; //end tr tag

                //showing all data
                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  foreach ($all_property as $item) {
                        echo '<td>' . $row[$item] . '</td>'; //get items using property value
                      }
                      echo '</tr>';
                    }
                    echo "</table>";
            ?>



          <table id="myTable">
            <thead>
             <tr>
              <th>First Name</th>
              <th>Last Name</th> 
              <th>Birthday</th>
               <th>University</th>
            </thead>
            <tbody>
              <tr>
                <td>Jill</td>
                <td>Smith</td> 
                <td>50</td>
                <td>DLSU</td>
              </tr>
              <tr>
                <td>Eve</td>
                <td>Jackson</td> 
                <td>94</td>
                <td>ADMU</td>
              </tr>
            </tbody>
          </table>

         
        </div>
       
       
      </div>

      <hr>

      <footer>
        <p>© 2017 Company, Inc.</p>
      </footer>
    </div> <!-- /container -->


    </div><!-- /.container -->



		  <script src="js/jquery-3.2.1.min.js"></script>
 		  <script src="js/bootstrap.min.js"></script>
      <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
      <script>

        $(document).ready(function(){
          $('#myTable').DataTable();
        });

      </script>


	</body>
</html>
