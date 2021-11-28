<?php
class Hirek_Model
{
    public function saveArticle($article)
    {

        $retData['eredmeny'] = "";
        $retData['uzenet'] = "";
        try {

            $connection = Database::getConnection();

            $dateTime = date('Y-m-d H:i:s');

            $insert = "insert into hirek( tartalom, felhasznaloid, letrehozva)

                                values( :tartalom, " . $_SESSION['userid'] . ", '$dateTime')";
            $stmt = $connection->prepare($insert);

            if (isset($_POST['tartalom'])) {
                $stmt->execute(array(':tartalom' => $_POST['tartalom']));
            }
        } catch (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = "Kapcsolati probléma: " . $e->getMessage();
        }

        return $retData;
    }

    public function getArticles()
    {

        $connection = Database::getConnection();
        $sql = "SELECT h.tartalom, h.letrehozva, f.bejelentkezes FROM hirek h JOIN felhasznalok f ON h.felhasznaloId = f.id";
        $stmt = $connection->query($sql);
        $sqlresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $getData['hirek'] = $sqlresult;

        return $getData;
    }
}