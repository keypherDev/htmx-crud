<div class="form-content">
    <h2>Agregar Producto</h2>
    <form hx-post="actions.php?action=create" hx-target="#d-form">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required>
        
        <button type="submit">Guardar</button>
        <button type="button">Cancelar</button>
    </form>
</div>
