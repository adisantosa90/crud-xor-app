<?php
include 'config/database.php';
include 'includes/function.php';

if ($_POST) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    
    // Enkripsi data sensitif
    $email_encrypted = xor_encrypt($email, ENCRYPTION_KEY);
    $telepon_encrypted = xor_encrypt($telepon, ENCRYPTION_KEY);
    $alamat_encrypted = xor_encrypt($alamat, ENCRYPTION_KEY);
    
    try {
        $sql = "INSERT INTO users (nama, email, telepon, alamat) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $email_encrypted, $telepon_encrypted, $alamat_encrypted]);
        
        header("Location: read.php?success=1");
        exit();
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<?php include 'includes/header.php'; ?>
        <h2>Tambah Data Pengguna</h2>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>