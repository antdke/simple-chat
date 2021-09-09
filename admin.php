<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }

      td, th {
        border: 1px solid #a5c9e4;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #a5c9e4;
      }
    </style>
</head>
<body>
  <div id="container">

          <?php 
          include("config.php");

          // confirmation message to show that changes have been saved
          if ($_GET['confirmation'] == "savedtext"){
            print "<div style='color:green'><strong>Changes Saved!</strong></div>";
          }

          if ($_GET['error'] == "invalidroom"){
            print "<div style='color:red'><strong>Invalid room name!</strong></div>";
          }
        
        ?>

        <?php 
        
          // check the cookie - are they logged in?
          if ($_COOKIE['loggedin'] == 'yes') {
            print "<h1> Admin Panel </h1>";
            print "<p> Welcome Admin </p>";
            print "<p><a href='logout.php'>Logout</a></p>";
            print "<br />";
            
            // fill form with all bad words
            $bannedwords = file_get_contents($path."/banned.txt");
          
            ?>

            <!-- IF LOGGED IN -->

            <!-- Form to update bad words list -->
            <form action="savebannedwords.php" method="post">
              Banned Words:<br>
              <textarea name="bannedwords" cols="30" rows="10"><?php print $bannedwords ?></textarea>
              <input type="submit">
            </form>
            <br>
            <br>
            <!-- Form to erase data data -->
            <form action="deletechatcontent.php" method="post">
              Delete Room Contents: <br>
              Type: 'room1', 'room2', or 'room3'? <br>
              <input name="room" type="text">
              <input type="submit" value="delete">
            </form>

            <br>
            <br>
            <!-- Usage Logs -->
            
            <?php

            // access usagelog file
            $usagelog_path = $path . '/usagelog.txt'; 

            // access usagelog.txt
            $data = file_get_contents($path."/usagelog.txt");
            
            // split data into rows
            $data_rows = explode("\n", $data);

            print "<table>";
            print "<tr>
                    <th>TIMESTAMP</th>
                    <th>User IP Address</th>
                    <th>User</th>
                    <th>Action</th>
                  </tr>";
            // iterate through the split rows of the array
            for ($i = 0; $i < count($data_rows); $i++) {
              // split each row
              if ($data_rows[$i] == "") {
                continue;
              }
              $row = explode(",", $data_rows[$i]);
              $timestamp = date('F j, Y, g:i a', $row[0]);
              print "<tr>
                    <td>$timestamp</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                  </tr>";
            }
            print "</table>";


          } else {
        
        ?>

          <!-- IF NOT LOGGED IN -->
          <form method="POST" action="login.php">
            Username:
            <input type="text" name="username">
            Password:
            <input type="text" name="password">
            <input type="submit">
          </form>

          <?php

          }

          ?>

          <br>
          <br>
          <a href="./index.html"><- Back to Chat</a>

    </div>
</body>
</html>