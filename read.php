<?php
include 'config/database.php';
include 'includes/function.php';

// Ambil semua data
try {
    $sql = "SELECT * FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Dekripsi data
    foreach($users as &$user) {
        $user['email'] = xor_decrypt($user['email'], ENCRYPTION_KEY);
        $user['telepon'] = xor_decrypt($user['telepon'], ENCRYPTION_KEY);
        $user['alamat'] = xor_decrypt($user['alamat'], ENCRYPTION_KEY);
    }
} catch(PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>

<?php include 'includes/header.php'; ?>
        <h2>Data Pengguna</h2>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Data berhasil disimpan!</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['updated'])): ?>
            <div class="alert alert-success">Data berhasil diperbarui!</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-success">Data berhasil dihapus!</div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (empty($users)): ?>
            <div class="alert alert-info">Tidak ada data pengguna.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['nama']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['telepon']); ?></td>
                            <td><?php echo htmlspecialchars($user['alamat']); ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        
        <a href="create.php" class="btn btn-primary">Tambah Data Baru</a>
    </div>
</body>
</html>