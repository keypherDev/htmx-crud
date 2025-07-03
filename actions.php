<?php

require_once "database.php";

$action = $_GET["action"] ?? ""; 

switch ($action) {
    case 'create':
        // Crear producto
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio) 
            VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $descripcion, $precio]);
        /* respuesta para HTMX */
        header("HX-Trigger: list-updated"); 

        echo "Producto creado exitosamente!";
        break;
    case 'read':
        # Listado de productos
        $stmt = $pdo->query("SELECT * FROM productos ORDER BY created_at DESC");
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($productos)) {
            echo "<p>No hay productos registrados.</p>";
            break;
        }
        
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Acciones</th></tr>";
        
        foreach ($productos as $producto) {
            echo "<tr>";
            echo "<td>{$producto['nombre']}</td>";
            echo "<td>{$producto['descripcion']}</td>";
            echo "<td>\${$producto['precio']}</td>";
            echo "<td>";
            echo "<button hx-get='update.php?id={$producto['id']}' hx-target='#d-form'>Editar</button> ";
            echo "<button hx-get='actions.php?action=delete&id={$producto['id']}' hx-target='#d-form' hx-confirm='Estas seguro de eliminarlo?'>Eliminar</button>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        break;
    case 'update':
         // Actualizar producto
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        
        $stmt = $pdo->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=? WHERE id=?");
        $stmt->execute([$nombre, $descripcion, $precio, $id]);
        
        header('HX-Trigger: list-updated');
        echo "Producto actualizado exitosamente!";
        break;
    case 'delete':
        // Eliminar producto
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id=?");
        $stmt->execute([$id]);
        
        header('HX-Trigger: list-updated');
        echo "Producto eliminado exitosamente!";
        break;
    default:
        # code...
        break;
}
