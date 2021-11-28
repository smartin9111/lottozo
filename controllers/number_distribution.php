<?php

class Number_Distribution_Controller 
{

    public $baseName = "number_distribution";


	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        try {
            $connection = Database::getConnection();
            $stmt = $connection->prepare("select szam, count(huzasid) as darab from huzott group by szam order by szam");
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eredmeny["lista"][] = array("szam" => $row['szam'], "darab" => $row['darab']);
            }
        } catch(PDOException $e) {
        }
        echo json_encode($eredmeny);
	}
}

?>
