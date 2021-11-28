<?php
class Regisztralas_Model
{
    public function get_data($vars)
    {

        $retData['eredmeny'] = "";
        $retData['uzenet'] = "";
        try {
            // Kapcsolódás
            $connection = Database::getConnection();
            $connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            // Létezik már a felhasználói név?
            $sqlSelect = "select id from felhasznalok where bejelentkezes = :bejelentkezes";
            $sth = $connection->prepare($sqlSelect);
            $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo']));
            if ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                $retData['eredmeny'] = "OK";
                $retData['uzenet'] = "A felhasználói név már foglalt!";
            } else {
                // Ha nem létezik, akkor regisztráljuk
                $sqlInsert = "insert into felhasznalok(id, csaladi_nev, utonev, bejelentkezes, jogosultsag, jelszo)
                          values(0, :vezeteknev, :utonev, :bejelentkezes,'_1_', :jelszo)";
                $stmt = $connection->prepare($sqlInsert);
                $stmt->execute(array(
                    ':vezeteknev' => $_POST['vezeteknev'],
                    ':utonev' => $_POST['utonev'],
                    ':bejelentkezes' => $_POST['felhasznalo'],

                    ':jelszo' => sha1($_POST['jelszo'])
                ));
                if ($count = $stmt->rowCount()) {
                    $retData['eredmeny'] = "OK";
                    $retData['uzenet'] = "A regisztrációja sikeres";
                } else {
                    $retData['eredmeny'] = "ERROR";
                    $retData['uzenet'] = "Sikertelen regisztráció";
                }
            }
        } catch (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Kapcsolati probléma: " . $e->getMessage();
        }

        return $retData;
    }
}