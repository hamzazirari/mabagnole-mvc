<?php
abstract class BaseController {
protected PDO $pdo;

public function _construct(PDO $pdo) {
$this->pdo = $pdo;
}
protected function render(string $view, array $data = []): void {
extract($data);
require "app/views/layout/header.php";
require "app/views/$view.php";
require "app/views/layout/footer.php";

}
}
?>