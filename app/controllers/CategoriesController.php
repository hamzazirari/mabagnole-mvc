<?php
class CategoriesController extends BaseController {
    
  public function listAction(): void {
    $manager = new CategoryManager($this->pdo);
        $categories = $manager->getAllWithVehicules();
    
    $this->render('categories/list', ['categories' => $categories]);
}
}
?>