            </main>
        </div>
    </div>

    <div class="administrador">
        <div class="icon">
            <i class="fa-solid fa-circle-user"></i>
        </div>
        <div class="nombre">
            <?php
            $query = "SELECT * FROM inicio WHERE id = 1";
            $res = mysqli_query($conexion, $query);
            $admin = mysqli_fetch_assoc($res);
            ?>
            <div class="datos">
                <?php echo $admin["nombre"]; ?> <br>
                <?php echo $admin["apellidos"]; ?>
            </div>
            <div class="cargo">
                <b>Administrador</b>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>