<!DOCTYPE html>
<html>
<head>
  <title>Users</title>
</head>
<body>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Profile Picture</th>
    </tr>
    <?php
      // Read the contents of the users.csv file and display them in a table
      $users_file = fopen("users.csv", "r");
      while (($user_data = fgetcsv($users_file)) !== FALSE) {
        echo "<tr>";
        echo "<td>" . $user_data[0] . "</td>";
        echo "<td>" . $user_data[1] . "</td>";
        echo "<td><img src=\"uploads/" . $user_data[2] . "\"></td>";
        echo "</tr>";
      }
      fclose($users_file);
    ?>
  </table>
</body>
</html>
