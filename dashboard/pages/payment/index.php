<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

if (!isset($_GET['no']) || $_GET['no'] == '') {
    header('Location: ../my-order/');
}

// Mendapat informasi pesanan
$stmt = $conn->prepare("SELECT *, CONCAT('WP', LPAD(ps.no_pesanan, 5, '0')) AS nomor_pesanan
FROM penawaran pw
JOIN pemesanan ps ON ps.no_pesanan = pw.no_pesanan
JOIN pemesanan_item pi ON pi.no_pesanan = pw.no_pesanan
WHERE pw.no_pesanan = ? && status_penawaran = 3");
$stmt->bind_param('i', $_GET['no']);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../assets/css/user.css">
    <link rel="shortcut icon" href="../../../assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../assets/fontawesome/css/all.css">

    <!-- Sweetalert2 -->
    <script src="../../../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Daftar Pesanan - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <?php
    if (isset($_POST['bayar'])) {
        $no_pesanan = $_POST['no_pesanan'];
        $metode = $_POST['metode'];
        $bukti_bayar = $_FILES['bukti']['name'];
        $total_bayar = $_POST['total_bayar'];

        $split = explode('.', $_FILES['bukti']['name']);
        $ekstensi = $split[count($split) - 1];
        $bukti_bayar = "bukti_$no_pesanan" . "_" . uniqid() . '.' . $ekstensi;

        if (insertPembayaran($conn, $no_pesanan, $metode, $total_bayar, $bukti_bayar)) {
            $from = $_FILES['bukti']['tmp_name'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/bengkel-wahyu-putra/uploads/pembayaran/' . $bukti_bayar;

            if (move_uploaded_file($from, $to) && updateStatusPesanan($conn, $no_pesanan, 6)) {
                echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Terima kasih, bukti pembayaran Anda telah dikirim. Kami akan memverifikasinya dalam waktu maksimal 1x24 jam.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../my-order/';
                    }
                });
                </script>";
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat memindahkan pembayaran dan update status :(',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menambahkan pembayaran :(',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                </script>";
        }
    }
    ?>

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <section class="utama pembayaran">
            <h1>Pembayaran</h1>
            <hr class="hr-standar" style="width: 15dvw; margin: 10px auto;">
            <p>Harap selesaikan pembayaran untuk menyelesaikan pesanan <?= $row['nomor_pesanan'] ?></p><br>

            <form action="./?no=<?= $row['no_pesanan'] ?>" method="POST" enctype="multipart/form-data">
                <div class="progress-bar"></div>
                <div class="form-pembayaran">
                    <div class="step-form" id="form1">
                        <h2><?= $row['nomor_pesanan'] ?> - <?= $row['nama_item'] ?></h2>

                        <input type="hidden" value="<?= $row['no_pesanan'] ?>" name="no_pesanan" id="no_pesanan">

                        <div class="input-box">
                            <div class="radio-box">
                                <label for="bca">
                                    <img src="../../../assets/img/bca.png" alt="Bank BCA">
                                </label>
                                <input type="radio" name="metode" id="bca" value="BCA">
                            </div>
                            <div class="radio-box">
                                <label for="mandiri">
                                    <img src="../../../assets/img/mandiri.png" alt="Bank Mandiri">
                                </label>
                                <input type="radio" name="metode" id="mandiri" value="Mandiri">
                            </div>
                        </div>

                        <br>
                        <hr><br>

                        <strong style="font-size: 20px;">Total Bayar</strong>
                        <?php
                        $rp = number_format($row['harga'], 0, ',', '.')
                        ?>
                        <h1>Rp. <?= $rp ?></h1>
                        <input type="hidden" value="<?= $row['harga'] ?>" name="total_bayar" id="total_bayar">

                        <div class="btn" style="margin-top: 20px;">
                            <button type="button" id="next">
                                Lanjut Upload Bukti Pembayaran
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="step-form" id="form2">
                        <p style="margin-bottom: 10px;">WP0001 - Nama Item</p>
                        <p>Lakukan pembayaran ke nomor rekening:</p>

                        <div class="norek" id="next-bca">
                            <img src="../../../assets/img/bca.png" alt="Bank BCA">
                            <p>0181016859</p>
                            <p style="margin-bottom: 15px">A.n. MUANAM</p>
                        </div>

                        <div class="norek" id="next-mandiri">
                            <img src="../../../assets/img/mandiri.png" alt="Bank BCA">
                            <p>141-00-2199879-4</p>
                            <p style="margin-bottom: 15px">A.n. MUANAM</p>
                        </div>
                        
                        <!-- <div class="select-img">
                            <div class="img-area">

                                <h3>Upload Bukti</h3>
                            </div>
                        </div> -->
                        <img id="output" width="200px" style="height: auto; margin-bottom: 10px">

                        <div class="bukti">
                            <i class="fas fa-upload" style="font-size: 14px;"></i>
                            <label for="bukti">Upload Bukti Pembayaran</label>
                        </div>
                        
                        <input type="file" name="bukti" id="bukti" required hidden onchange="loadFile(event)">

                        <script>
                            var loadFile = function(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('output');
                                    output.src = reader.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            };
                        </script>

                        <br><br>
                        <hr>
                        <br>

                        <h1>Rp. <?= $rp ?></h1>

                        <div class="btn" style="margin-top: 20px;">
                            <button type="button" id="back">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </button>
                            <button type="submit" id="submit" name="bayar">
                                Simpan
                                <i class="fas fa-floppy-disk"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <script src="../../../assets/js/script.js"></script>
    <script>
        let bank;
        const input = document.querySelectorAll("input[type='radio']");
        const form1 = document.getElementById('form1');
        const form2 = document.getElementById('form2');

        const next = document.getElementById('next');
        const back = document.getElementById('back');
        const submit = document.getElementById('submit');

        const bca = document.getElementById('next-bca');
        const mandiri = document.getElementById('next-mandiri');

        // const heightForm = document.querySelector('.form-pesanan');
        const progressBar = document.querySelector('.progress-bar');

        input.forEach(input => {
            input.addEventListener('change', function() {
                bank = this.value;
            })
        });

        next.addEventListener('click', function() {
            if (bank == undefined) {
                Swal.fire({
                    title: "Pilih Metode Pembayaran",
                    text: "Harap pilih metode pembayaran yang tersedia!",
                    icon: "warning",
                    confirmButtonText: "OK"
                });
            } else if (bank == 'BCA') {
                form1.style.display = 'none';
                form2.style.display = 'block';
                progressBar.style.width = '100%';
                progressBar.style.borderRadius = '10px 10px 0px 0px';
                mandiri.style.display = 'none';
                bca.style.display = 'block';
            } else if (bank == 'Mandiri') {
                form1.style.display = 'none';
                form2.style.display = 'block';
                progressBar.style.width = '100%';
                progressBar.style.borderRadius = '10px 10px 0px 0px';
                mandiri.style.display = 'block';
                bca.style.display = 'none';
            }
        })

        back.onclick = function() {
            form2.style.display = 'none';
            form1.style.display = 'block';
            progressBar.style.width = '50%';
            progressBar.style.borderRadius = '10px 5px 5px 0px';
        }
    </script>
</body>

</html>