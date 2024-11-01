<?php

/* require("models/category.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['action']) && $data['action'] === 'delete_category' && !empty($data['recipe_category_id'])) {
        $recipeCategoryId = (int)$data['recipe_category_id'];
        
        $categoryModel = new Category();
        $deleted = $categoryModel->deleteCategoryById($recipeCategoryId);
        
        header('Content-Type: application/json');
        if ($deleted) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erro ao apagar a categoria.']);
        }
        exit();
    }   else {
        
        echo json_encode(['success' => false, 'error' => 'Ação não reconhecida.']);
        exit();
    }
} */