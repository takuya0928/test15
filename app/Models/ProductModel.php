<?php
require_once 'db.php';
// DB接続

class ProductModel {
    public static function all() {
        global $pdo;
        return $pdo->query("SELECT * FROM products")->fetchALL();
    }

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

public static function create($name, $maker, $price, $stock, $comment, $image_path)
{global $pdo;
$stmt = $pdo->prepare("INSERT INTO products (name, maker, price, stock, comment, image_path)
VALUES (?,?,?,?,?,?)");
return $stmt->execute([$name, $maker, $price, $stock, $comment, $image_path]);}

public static function update($id, $name, $maker, $price, $stock, $comment, $image_path){
    global $pdo;
    $stmt = $pdo->prepare("UPDATE products SET name=?, maker=?, price=?,stock=?, comment=?, image_path=?, WHERE id=?");
    return $stmt->execute([$name, $maker, $price, $stock, $comment, $image_path, $id]);
}

public static function delete($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    return $stmt->execute([$id]);
}

}