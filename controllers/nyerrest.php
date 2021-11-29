<?php

class Nyerrest_Controller
{
	public $baseName = 'nyerrest';  
	public function main(array $vars) 
	{
		$eredmeny = "";
        try {
            $connection = Database::getConnection();
            switch($_SERVER['REQUEST_METHOD']) {
                case "GET":
                        $sql = "SELECT * FROM huzott ORDER BY id DESC";     
                        $sth = $connection->query($sql);
                        $eredmeny = array();
                        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                            $eredmeny[] = array("id" => $row["id"], 
                            "huzasid" => $row["huzasid"], "szam" => $row["szam"]);
                        }
                        
                    break;
                case "POST":
                        $sql = "insert into huzott (huzasid, szam) values (:hid, :szam)";
                        $sth = $connection->prepare($sql);
                        $count = $sth->execute(Array(":hid"=>$vars["huzasid"], ":szam"=>$vars["szam"]));
                        $newId = $connection->lastInsertId();
                        $eredmeny = array("id" => $newId);
                    break;
                case "PUT":
                        $data = array();
                        $incoming = file_get_contents("php://input");
                        parse_str($incoming, $data);
                        $params = Array(":id" => $data["id"], ":hid" => $data["hid"], ":szam" => $data["szam"]);
                        $sql = "update huzott set huzasid=:hid, szam=:szam where id=:id";
                        $sth = $connection->prepare($sql);
                        $count = $sth->execute($params);
                        $eredmeny = array("id" => $data["id"]);
                    break;
                case "DELETE":
                        $data = array();
                        $incoming = file_get_contents("php://input");
                        parse_str($incoming, $data);
                        $sql = "delete from huzott where id=:id";
                        $sth = $connection->prepare($sql);
                        $count = $sth->execute(Array(":id" => $data["id"]));
                        $eredmeny = array("id" => $data["id"]);
                    break;
            }
        }
        catch (PDOException $e) {
            $eredmeny = $e->getMessage();
        }
        echo json_encode($eredmeny);
	}
}



?>