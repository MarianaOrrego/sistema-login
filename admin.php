<?php 
    session_start();
    require_once "./inc/config.php";
    if (!isset($_SESSION['user_id'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'inc/head.php'; ?>
<body>
    <div class="container">
        <div class="row d-flex justify-content-around mt-5">
            <div class="card col-md-6 col-md-offset-6">
                <article class="card-body">
                    <h1>Bienvenido a mi ADMIN</h1>

                </article>
            </div>
            <div>
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
    <?php include_once 'inc/footer.php'; ?>
</body>
</html>