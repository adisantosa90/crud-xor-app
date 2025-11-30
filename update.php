<?php
include 'config/database.php';
include 'includes/function.php';

$id = $_GET['id'];

// Ambil data berdasarkan ID
try {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Dekripsi data
        $user['email'] = xor_decrypt($user['email'], ENCRYPTION_KEY);
        $user['telepon'] = xor_decrypt($user['telepon'], ENCRYPTION_KEY);
        $user['alamat'] = xor_decrypt($user['alamat'], ENCRYPTION_KEY);
    } else {
        die("Data tidak ditemukan");
    }
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

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
        $sql = "UPDATE users SET nama = ?, email = ?, telepon = ?, alamat = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $email_encrypted, $telepon_encrypted, $alamat_encrypted, $id]);
        
        header("Location: read.php?updated=1");
        exit();
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<?php include 'includes/header.php'; ?>
        <h2>Edit Data Pengguna</h2>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo htmlspecialchars($user['telepon']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($user['alamat']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="read.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>