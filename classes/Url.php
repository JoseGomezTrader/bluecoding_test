<?php
require_once("Database.php");
class Url
{
	/**
	 * @var connection save the db connection
	*/
    public $connection;

	public function __construct()
	{
		$this->connection = new Database();
	}

    public function redirecto($code)
    {
        /**
         * param $code, String, Ie: '62c4d39c9af07'
         * return url gotten to redirect
         */
        $DB = new Database();
        $query = "SELECT * FROM url WHERE code = ? LIMIT 1";
        $stmt = $DB->connection->prepare($query);
        $stmt->bindParam(1, $code);
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (isset($result)) {
                $date = new DateTime();
                $counter = intval($result["counter"]) + 1;
                $data = [
                    "id" => $result["id"],
                    "counter" => $counter,
                    "timemodified" => $date->getTimestamp()
                ];
                $query = "UPDATE url SET `counter`=:counter, timemodified=:timemodified WHERE id=:id";
                $stmt = $DB->connection->prepare($query);
                if($stmt->execute($data)){
                    return $result["redirecto"];
                }
            }
        }
    }

    public function shorturl($url){
        /**
         * param $url, String, Ie: 'https://www.google.com.co'
         * return code of the URL generated.
         */
        $code = uniqid();
        $date = new DateTime();
        $DB = new Database();


        $query = "INSERT INTO url (redirecto,code,timecreated,timemodified) VALUES(:redirecto,:code,:timecreated,:timemodified)";
		$stmt = $DB->connection->prepare($query);

        $data = [
            "redirecto" => $url,
            "code" => $code,
            "timecreated" => $date->getTimestamp(),
            "timemodified" => $date->getTimestamp()
        ];

        $stmt = $DB->connection->prepare($query);
		if ($stmt->execute($data)) {
			return ($DB->connection->lastInsertId()) ? $code : false;
		}
    }

    public function get_top($limit=100){
        /**
         * param $limit, Integer optional, Ie: 100
         * return 100 most frecuently used urls
         */
        $DB = new Database();
        $query = "SELECT * FROM url ORDER BY counter DESC LIMIT ".$limit;
        $stmt = $DB->connection->prepare($query);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (isset($result)) {
                return $result;
            }
        }
    }

    public function get_url_title_null(){
        /**
         * return all register with null in title
         */
        $DB = new Database();
        $query = "SELECT * FROM url WHERE title IS NULL";
        $stmt = $DB->connection->prepare($query);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (isset($result)) {
                return $result;
            }
        }
    }

    public function update_url_title($id, $title){
        /**
         * param $id, Integer, Ie: 15
         * param $title, Integer optional, Ie: 'Web Page Name'
         * return true if updated the register
         */
        $DB = new Database();
        $date = new DateTime();
        $data = [
            "id" => $id,
            "title" => $title,
            "timemodified" => $date->getTimestamp()
        ];
        $query = "UPDATE url SET title=:title, timemodified=:timemodified WHERE id=:id";
        $stmt = $DB->connection->prepare($query);
        if($stmt->execute($data)){
            return true;
        }
    }
}