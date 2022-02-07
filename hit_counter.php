<?php
    $user = "YOURUSER";
    $password = "YOURPASSWORD";
    $database = "YOURDATABASE";

    try {

        $db = new PDO("mysql:host=mysql;dbname=$database", $user, $password);

        $siteVisitsMap  = 'siteStats';
        $visitorKey = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

           $visitorKey = $_SERVER['HTTP_CLIENT_IP'];

        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

           $visitorKey = $_SERVER['HTTP_X_FORWARDED_FOR'];

        } else {

           $visitorKey = $_SERVER['REMOTE_ADDR'];
        }

        $totalVisits = 0;

        $sql="SELECT dir_ip, vis FROM cont WHERE dir_ip=:dir_ip";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':dir_ip', $visitorKey);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->execute();
        
        if ($result) {

            $row = $stmt->fetch();
            $totalVisits = $row['vis'] + 1;

        } else {

            $totalVisits = 1;

        }

        $sql = "INSERT INTO cont (dir_ip, vis) VALUES (:dir_ip, :vis) ON DUPLICATE KEY UPDATE vis=:vis";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':dir_ip', $visitorKey);
        $stmt->bindParam(':vis', $totalVis);

        $stmt->execute();
        

        echo "Bienvenido a un contador de visitas, has visto esta web " .  $totalVis . " veces\n Empieza a hacer algo productivo \n";

    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>
