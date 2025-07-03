<?php
include 'database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="form-content">
    <h2>Editar Producto</h2>
    <form hx-post="actions.php?action=update" hx-target="#d-form">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>
        
        <button type="submit">Actualizar</button>
        <button type="button" hx-get="">Cancelar</button>
    </form>
</div>
