<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CRUD HTMX</title>
        <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.5/dist/htmx.min.js" integrity="sha384-t4DxZSyQK+0Uv4jzy5B0QyHyWQD2GFURUmxKMBVww9+e2EJ0ei/vCvv7+79z0fkr" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div class="container">
            <h1>Productos</h1>
            <button hx-get="create.php" hx-target="#d-form" hx-trigger="click">
                Agregar producto
            </button>
            <div id="d-form"></div>
            <!-- listado de productos -->
            <div id="productos" hx-get="actions.php?action=read" 
                hx-trigger="load, list-updated from:body">
                Cargando productos...
            </div>
        </div>
    </body>
</html>
