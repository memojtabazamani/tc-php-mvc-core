<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 17/11/2025
 * Time: 05:09 PM
 */

namespace app\core\db;


use app\core\Application;
use app\models\Model;

#[\AllowDynamicProperties]
abstract class DbModel extends Model
{
    public static function tableName(): string
    {
        return ''; // or throw exception
    }
    abstract public function attributes(): array;

    abstract static public function pK(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes  = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("
        INSERT INTO $tableName (".implode(', ', $attributes).") 
        VALUES(".implode(',',$params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function findOne($where)
    {
        $tableName = static::tableName(); // static late binding
        $attrs = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attrs));
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $stmt->bindValue(":$key", $item);
        }
        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$APP->db->pdo->prepare($sql);
    }
}