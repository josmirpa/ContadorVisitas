<!DOCTYPE html>
<html>

  <head>
    <title>Contador de visitas con MySQL</title>
  </head>

  <body>

      <h1>Contador de visitas</h1>

      <table border = '1'>
        <tr>
          <th>No.</th>
          <th>Visitante</th>
          <th>Total Visitas</th>
        </tr>

        <?php
            $user = "alumno";
            $password = "Password123#@!";
            $database = "bbdd";

            try {

                $db = new PDO("mysql:host=mysql;dbname=$database", $user, $password);

                $siteVisitsMap = 'siteStats';

                $i = 1;
                foreach($db->query("SELECT dir_ip, visitas FROM contador") as $row) {
                    echo "<tr>";
                      echo "<td align = 'left'>"   . $i . "."     . "</td>";
                      echo "<td align = 'left'>"   . $row['dir_ip']     . "</td>";
                      echo "<td align = 'right'>"  . $row['visitas'] . "</td>";
                    echo "</tr>";

                    $i++;
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }

        ?>

      </table>
  </body>

</html>
