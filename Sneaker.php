<?php
include_once("adb.php");

class Sneaker extends adb
{

    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public function login($username, $password)
    {
        $loginQuery = /** @lang MySQL */
            "SELECT *
            FROM `users`
            WHERE `users`.`cust_username` = ?
            AND `users`.`cust_password` = ?";

        if ($statement = $this->prepare($loginQuery)) {
            $statement->bind_param("ss", $username, $password);
            $statement->execute();
            return $statement->get_result();
        }
        $statement->close();
        return false;
    }


    public function displaySneakers($limit, $offset)
    {
        $query = "SELECT `id`, `brand_name`, `size`, `color`, `price` FROM `sneakers`

                        ORDER BY 'id' ASC";

        if ($statement = $this->prepare($query)) {
            $statement->bind_param("ss", $limit, $offset);
            $statement->execute();
            return $statement->get_result();
        }
        $statement->close();
        return false;
    }

    public function allSneaker()
    {
        $query = "SELECT * FROM sneakers";

        return $this->query($query);
    }


    public function countSneaker()
    {
        $countSneakersQuery = "SELECT COUNT(*)
                           AS `id`
                           FROM `sneakers`";

        if ($statement = $this->prepare($countSneakersQuery)) {
            $statement->execute();
            return $statement->get_result();
        }
        $statement->close();
        return false;
    }


    public function search($searchWord)
    {
        $word = '%'.$searchWord.'%';

        $searchQuery = "SELECT * FROM sneakers WHERE brand_name LIKE ?";
        $s = $this->prepare($searchQuery);
        $s->bind_param('s',$word);
        $s->execute();
        return $s->get_result();
    }


    public function selectSneaker($sneakerId)
    {
        $selectQuery = "SELECT * FROM sneakers WHERE id = ?";

        $s = $this->prepare($selectQuery);
        $s->bind_param('i',$sneakerId);
        $s->execute();
        return $s->get_result();
    }

    public function insert($f,$l,$e,$a){

        $q = "INSERT INTO customers (firstname, lastname, email, address) VALUES (?,?,?,?)";
        $s = $this->prepare($q);
        $s->bind_param('ssss',$f,$l,$e,$a);
        $s->execute();
}
}