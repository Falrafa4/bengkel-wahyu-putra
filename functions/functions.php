<?php
// ADMIN OR USER CAN USE IT

// PELANGGAN
function insertPelanggan($conn, $password, $nama_pelanggan, $email, $no_telp, $jenis_akun, $nama_perusahaan, $role) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO pelanggan (password, nama_pelanggan, email, no_telp, jenis_akun, nama_perusahaan, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $hash, $nama_pelanggan, $email, $no_telp, $jenis_akun, $nama_perusahaan, $role);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updatePelanggan($conn, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role, $id_pelanggan) {
    $query = "UPDATE pelanggan SET nama_pelanggan = ?, email = ?, no_telp = ?, jenis_akun = ?, role = ? WHERE id_pelanggan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssi', $nama_pelanggan, $email, $no_telp, $jenis_akun, $role, $id_pelanggan);
    
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function deletePelanggan($conn, $id_pelanggan) {
    $query = "DELETE FROM pelanggan WHERE id_pelanggan = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_pelanggan);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// PEMESANAN
function insertPemesanan($conn, $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $id_service) {
    $query = 'INSERT INTO pemesanan (id_pelanggan, nama_jalan, kecamatan, kabupaten_kota, provinsi, kode_pos, detail, id_service)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssssi', $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $id_service);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updatePemesanan($conn, $no_pesanan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $id_service, $id_pelanggan) {
    $query = 'UPDATE pemesanan SET id_pelanggan = ?, nama_jalan = ?, kecamatan = ?, kabupaten_kota = ?, provinsi = ?, kode_pos = ?, detail = ?, id_service = ? WHERE no_pesanan = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssssii', $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $id_service, $no_pesanan);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updateStatusPesanan($conn, $no_pesanan, $status_pesanan) {
    $query = 'UPDATE pemesanan SET status_pesanan = ? WHERE no_pesanan = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii',$status_pesanan, $no_pesanan);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function deletePemesanan($conn, $no_pesanan) {
    $query = 'DELETE FROM pemesanan WHERE no_pesanan = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $no_pesanan);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// PEMESANAN ITEM
function insertPemesananItem($conn, $no_pesanan, $nama_item, $desain_gambar, $material, $jumlah_item) {
    $query = 'INSERT INTO pemesanan_item (no_pesanan, nama_item, desain_gambar, material, jumlah_item)
    VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isssi', $no_pesanan, $nama_item, $desain_gambar, $material, $jumlah_item);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// PENAWARAN
function getPenawaran($conn, $id_pelanggan) {
    $query = "SELECT *, CONCAT('WP', LPAD(ps.no_pesanan, 5, '0')) AS nomor_pesanan, DATE_FORMAT(pw.tgl_penawaran, '%d-%m-%Y') as tgl_penawaran
            FROM penawaran pw
            JOIN pemesanan ps ON ps.no_pesanan = pw.no_pesanan
            WHERE ps.id_pelanggan = ?
            ORDER BY pw.tgl_penawaran DESC;";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_pelanggan);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function insertPenawaran($conn, $no_pesanan, $harga, $surat_penawaran) {
    $query = 'INSERT INTO penawaran (no_pesanan, harga, surat_penawaran) VALUES (?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $no_pesanan, $harga, $surat_penawaran);
    
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updatePenawaran($conn, $no_pesanan, $surat_penawaran, $harga, $id_penawaran) {
    $query = 'UPDATE penawaran SET no_pesanan = ?, surat_penawaran = ?, harga = ? WHERE id_penawaran = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isii', $no_pesanan, $surat_penawaran, $harga, $id_penawaran);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updateStatusPenawaran($conn, $status_penawaran, $id_penawaran) {
    $query = 'UPDATE penawaran SET status_penawaran = ? WHERE id_penawaran = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $status_penawaran, $id_penawaran);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function deletePenawaran($conn, $id_penawaran) {
    $query = 'DELETE FROM penawaran WHERE id_penawaran = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_penawaran);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// NEGOSIASI
function insertNegosiasi($conn, $id_penawaran, $jenis_negosiasi, $harga_tawaran, $estimasi_tawaran, $catatan) {
    $query = 'INSERT INTO negosiasi_penawaran (id_penawaran, jenis_negosiasi, harga_tawaran, estimasi_tawaran, catatan) VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isiss', $id_penawaran, $jenis_negosiasi, $harga_tawaran, $estimasi_tawaran, $catatan);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updateStatusNegosiasi($conn, $id_negosiasi, $status_negosiasi) {
    $query = 'UPDATE negosiasi_penawaran SET status_negosiasi = ? WHERE id_negosiasi = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $status_negosiasi, $id_negosiasi);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// PEMBAYARAN
function insertPembayaran($conn, $no_pesanan, $metode_pembayaran, $total_bayar, $bukti_bayar) {
    $query = 'INSERT INTO pembayaran (no_pesanan, metode_pembayaran, total_bayar, bukti_bayar) VALUES (?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isis', $no_pesanan, $metode_pembayaran, $total_bayar, $bukti_bayar);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updateStatusPembayaran($conn, $id_pembayaran, $status_bayar) {
    $query = 'UPDATE pembayaran SET status_bayar = ? WHERE id_pembayaran = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $status_bayar, $id_pembayaran);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// PASSWORD
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

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// SERVICE
function updateService($conn, $id_service, $gambar_jasa) {
    $query = 'UPDATE service SET gambar_jasa = ? WHERE id_service = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $gambar_jasa, $id_service);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// USER ONLY
function updateProfil($method, $conn) {
    $id_pelanggan = $method['id_pelanggan'];
    $nama_pelanggan = $method['nama_pelanggan'];
    $email = $method['email'];
    $no_telp = $method['no_telp'];
    $jenis_akun = $method['jenis_akun'];
    $nama_perusahaan = $method['nama_perusahaan'] ?? '';

    $queryUpdate = "UPDATE pelanggan SET nama_pelanggan = ?, email = ?, no_telp = ?, jenis_akun = ?, nama_perusahaan = ? WHERE id_pelanggan = ?;";
    $stmt = $conn->prepare($queryUpdate);

    $stmt->bind_param('sssssi', $nama_pelanggan, $email, $no_telp, $jenis_akun, $nama_perusahaan, $id_pelanggan);
    
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