<?php
    $dbh = new PDO('mysql:host=localhost;dbname=lottozo', 'root', '',
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sqlInsert = "insert into nyeremeny(id, huzasid, talalat, darab, ertek)
                  values(:id, :huzasid, :talalat, :darab, :ertek)";
    $stmt = $dbh->prepare($sqlInsert);    
    $sqlInsert2 = "insert into huzas(id, ev, het)
                  values(:id, :ev, :het)";
    $stmt2 = $dbh->prepare($sqlInsert2);    
    $sqlInsert3 = "insert into huzott(id, huzasid, szam)
                  values(:id, :hid, :szam)";
    $stmt3 = $dbh->prepare($sqlInsert3);    

    $myfile = fopen("huzott.txt", "r") or die("Unable to open file!");
    fscanf($myfile, "%s %s %s", $h1, $h2, $h3);
    while (fscanf($myfile, "%d %d %d", $id, $hid, $szam)) {
                
       $stmt3->execute(array(
                    ':id' => $id,
                    ':hid' => $hid,
                    ':szam' => $szam,
                ));
    }
    fclose($myfile);

    $myfile = fopen("huzas.txt", "r") or die("Unable to open file!");
    fscanf($myfile, "%s %s %s", $h1, $h2, $h3);
    while (fscanf($myfile, "%d %d %d", $id, $ev, $het)) {
                
       $stmt2->execute(array(
                    ':id' => $id,
                    ':ev' => $ev,
                    ':het' => $het,
                ));
    }
    fclose($myfile);
    
    $myfile = fopen("nyeremeny.txt", "r") or die("Unable to open file!");
    fscanf($myfile, "%s %s %s %s %s", $h1, $h2, $h3, $h4, $h5);
    while (fscanf($myfile, "%d %d %d %d %d", $id, $hid, $talalat, $darab, $nyeremeny)) {
                
       $stmt->execute(array(
                    ':id' => $id,
                    ':huzasid' => $hid,
                    ':talalat' => $talalat,
                    ':darab' => $darab,
                    ':ertek' => $nyeremeny,
                ));
    }
    fclose($myfile);

?>