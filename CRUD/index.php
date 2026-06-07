<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $npm = mysqli_real_escape_string($conn, $_POST['npm']);
    mysqli_query($conn, "INSERT INTO mahasiswa (nama, npm) VALUES ('$nama', '$npm')");
    header("Location: index.php");
    exit;
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $npm = mysqli_real_escape_string($conn, $_POST['npm']);
    mysqli_query($conn, "UPDATE mahasiswa SET nama='$nama', npm='$npm' WHERE id='$id'");
    header("Location: index.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id='$id'");
    header("Location: index.php");
    exit;
}

if (isset($_GET['edit'])) {
    $id = mysqli_real_escape_string($conn, $_GET['edit']);
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
    $editData = mysqli_fetch_assoc($result);
}

$data = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
</head>
<body>

<h2>Data Mahasiswa</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= isset($editData) ? $editData['id'] : '' ?>">

    Nama: 
    <input type="text" name="nama" required 
    value="<?= isset($editData) ? $editData['nama'] : '' ?>">

    NPM: 
    <input type="text" name="npm" required 
    value="<?= isset($editData) ? $editData['npm'] : '' ?>">

    <?php if (isset($editData)): ?>
        <button type="submit" name="update">Update</button>
    <?php else: ?>
        <button type="submit" name="tambah">Tambah</button>
    <?php endif; ?>
</form>

<br>

<table border="1" cellpadding="5">
<tr>
    <th rowspan="2">No</th>
    <th rowspan="2">Nama</th>
    <th rowspan="2">NPM</th>
    <th colspan="2">Aksi</th>
</tr>
<tr>
    <th>Edit</th>
    <th>Hapus</th>
</tr>

<?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row['nama']) ?></td>
    <td><?= htmlspecialchars($row['npm']) ?></td>
    <td><a href="?edit=<?= $row['id'] ?>">Edit</a></td>
    <td><a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>