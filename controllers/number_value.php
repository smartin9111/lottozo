<?php

class Number_Value_Controller 
{

    public $baseName = "number_value";


	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        switch($vars['op']) {
            case 'year':
                $eredmeny = array("lista" => array());
                try {

                    $connection = Database::getConnection();
                    $stmt = $connection->query("select distinct ev from huzas");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eredmeny["lista"][] = array("ev" => $row['ev']);
                    }
                } catch(PDOException $e) {
                }
                echo json_encode($eredmeny);
                break;
            case 'info':
                $eredmeny["lista"] = array();
                try {
                    $connection = Database::getConnection();
                    $stmt = $connection->prepare("SELECT huzas.ev AS ev, huzas.het AS het, nyeremeny.ertek AS ertek, nyeremeny.talalat AS talalat " . 
                                "FROM huzas JOIN nyeremeny ON nyeremeny.huzasid = huzas.id " . 
                                "WHERE huzas.ev = :ev AND huzas.id IN " . 
                                    "(SELECT DISTINCT huzasid FROM huzott WHERE huzott.szam = :szam1 INTERSECT SELECT DISTINCT huzasid FROM huzott WHERE huzott.szam = :szam2)" .
                                    "ORDER BY huzas.ev asc, huzas.het asc, nyeremeny.talalat DESC");
                    $stmt->execute(Array(":ev" => $vars["ev"], ":szam1" => $vars["szam1"], ":szam2" => $vars["szam2"]));

                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eredmeny["lista"][] = array("ev" => $row['ev'], "het" => $row['het'], "ertek" => $row['ertek'], "talalat" => $row['talalat']);
                    }
                    
                    
                } catch(PDOException $e) {
                }
                echo json_encode($eredmeny);
                break;        
        }
	}
/*
    public function accept(array $vars) { 

        }
    }*/
}

?>
