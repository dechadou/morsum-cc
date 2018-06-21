<?php
/**
 * Created by PhpStorm.
 * User: dechadou-pc
 * Date: 20/6/2018
 * Time: 4:50 PM
 */

namespace App\Repository;

use PDO;
use Src\Database;
use App\Interfaces\Crud;

class User implements Crud
{

    public static function prepare($sql, $binding = false)
    {
        $connection = Database::instance();
        $query = $connection->prepare($sql);
        if ($binding) {
            if (is_array($binding)) {
                foreach ($binding as $param => &$value) {
                    $query->bindParam($param, $value);
                }
            } else {

                $query->bindParam(1, $binding);
            }
        }

        $query->execute();
        return $query;
    }

    /**
     * @return mixed
     */
    public static function all()
    {
        try {
            $query = self::prepare("SELECT * from users");
            return $query->fetchAll(PDO::FETCH_CLASS, "App\Entities\User");
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function find($id)
    {
        try {
            $query = self::prepare("SELECT * from users WHERE id = ?", $id);
            return $query->fetchAll(PDO::FETCH_CLASS, "App\Entities\User");
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
    }

    /**
     * @param $data
     */
    public static function store($data)
    {

        try {
            self::prepare("INSERT INTO users (name, lastname, address, email, phone) VALUES (:name, :lastName, :address, :email, :phone)", $data);
        } catch (\PDOException $e) {
            print "Error: " . $e->getMessage();
        }
    }

    /**
     * @param $data
     * @return
     */
    public static function update($data)
    {
        try {
            $query = self::prepare("UPDATE users SET name = :name, lastname = :lastname, address = :address, email = :email, phone = :phone  WHERE id = :id", $data);
            return $query;
        } catch (\PDOException $e) {
            print "Error: " . $e->getMessage();
        }
    }

    /**
     * @param $id
     */
    public static function destroy($id)
    {
        try {
            self::prepare("DELETE FROM users WHERE id = ?", $id);
        } catch (\PDOException $e) {
            print "Error: " . $e->getMessage();
        }
    }

    public static function search($term)
    {
        $data = [':term' => '%'.$term.'%'];
        try {
            $query = self::prepare("SELECT * FROM users WHERE name LIKE :term OR lastname LIKE :term OR address LIKE :term OR email LIKE :term OR phone LIKE :term", $data);
            return $query->fetchAll(PDO::FETCH_CLASS, "App\Entities\User");
        }  catch (\PDOException $e) {
            print "Error: " . $e->getMessage();
        }
    }
}
