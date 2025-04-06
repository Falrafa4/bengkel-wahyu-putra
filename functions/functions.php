<?php
// ADMIN OR USER CAN USE IT
function insertPelanggan($conn, $password, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO pelanggan (password, nama_pelanggan, email, no_telp, jenis_akun, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $hash, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role);

    return $stmt->execute();
    $stmt->close();
}

function updatePelanggan($conn, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role, $id_pelanggan) {
    $query = "UPDATE pelanggan SET nama_pelanggan = ?, email = ?, no_telp = ?, jenis_akun = ?, role = ? WHERE id_pelanggan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssi', $nama_pelanggan, $email, $no_telp, $jenis_akun, $role, $id_pelanggan);
    
    return $stmt->execute();
    $stmt->close();
}

function deletePelanggan($conn, $id_pelanggan) {
    $query = "DELETE FROM pelanggan WHERE id_pelanggan = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_pelanggan);

    return $stmt->execute();
    $stmt->close();
}

function insertPemesanan($conn, $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $layanan) {
    $query = 'INSERT INTO pemesanan (id_pelanggan, nama_jalan, kecamatan, kabupaten_kota, provinsi, kode_pos, detail, id_service)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssssi', $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $layanan);

    return $stmt->execute();
    $stmt->close();
}

function insertPemesananItem($conn, $no_pesanan, $nama_item, $desain_gambar, $material, $jumlah_item) {
    $query = 'INSERT INTO pemesanan_item (no_pesanan, nama_item, desain_gambar, material, jumlah_item)
    VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isssi', $no_pesanan, $nama_item, $desain_gambar, $material, $jumlah_item);

    return $stmt->execute();
    $stmt->close();
}

function getPassword($conn, $email) {
    $password = '';
    $query = 'SELECT password FROM pelanggan WHERE email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();
    $stmt->close();

    return $password;
}

function updatePassword($conn, $id_pelanggan, $password) {
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'UPDATE pelanggan SET password = ? WHERE id_pelanggan = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $newHash, $id_pelanggan);

    return $stmt->execute();
    $stmt->close();
}


// USER ONLY
function updateProfil($method, $conn) {
    $id_pelanggan = $method['id_pelanggan'];
    $nama_pelanggan = $method['nama_pelanggan'];
    $email = $method['email'];
    $no_telp = $method['no_telp'];
    $jenis_akun = $method['jenis_akun'];

    $queryUpdate = "UPDATE pelanggan SET nama_pelanggan = ?, email = ?, no_telp = ?, jenis_akun = ? WHERE id_pelanggan = ?;";
    $stmt = $conn->prepare($queryUpdate);

    $stmt->bind_param('ssssi', $nama_pelanggan, $email, $no_telp, $jenis_akun, $id_pelanggan);
    
    if($stmt->execute()) {
        $querySelect = "SELECT * FROM pelanggan WHERE id_pelanggan = ?";
        $stmtSelect = $conn->prepare($querySelect);

        $stmtSelect->bind_param('i', $id_pelanggan);
        $stmtSelect->execute();

        $result = $stmtSelect->get_result();
        $data = mysqli_fetch_assoc($result);

        $_SESSION['data'] = $data;
        $_SESSION['eksekusi'] = "Data Berhasil Diubah!";
        return true;
    } else {
        return false;
    }

    $stmt->close();
}