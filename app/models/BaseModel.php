<?php 
namespace App\Models;
use PDO;

abstract class BaseModel {
protected $pdo;

protected function __construct(PDO $pdo) {
$this->pdo = $pdo;
}
abstract public function save( ): bool;
abstract public static function find(int $id);

}
?>