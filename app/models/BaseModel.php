<?php 
abstract class BaseModel {
protected $pdo;

protected function __ construct(PDO $pdo) {
$this->pdo = $pdo;
}
abstract public function save( ): bool;
abstract public static function find(int $id);

}
?>