<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = htmlspecialchars(trim($_POST["nama"]));
    $status = htmlspecialchars(trim($_POST["status"]));
    $ulasan = htmlspecialchars(trim($_POST["isi-ulasan"]));
    $rating = $_POST["rating"];
    $tanggal = date("d F Y");

    // Cek apakah jumlah data sudah mencapai batas
    $count_query = "SELECT COUNT(*) AS jumlah FROM ulasan";
    $count_result = $conn->query($count_query);
    $count_row = $count_result->fetch_assoc();

    if ($count_row['jumlah'] >= 4) {
        showAlert('❌ Batas maksimal ulasan telah tercapai.');
    }

    // Cek apakah nama sudah ada di database
    $check_query = "SELECT nama FROM ulasan WHERE nama = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $nama);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        showAlert('❌ Nama sudah ada dalam database. Silakan gunakan nama lain.');
    }

    $uploadDir = "lampiran/";
    $fileName = "";

    if (!empty($_FILES["lampiran"]["name"])) {
        $ext = strtolower(pathinfo($_FILES["lampiran"]["name"], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($ext, $allowed_types)) {
            showAlert('❌ Format file tidak didukung. Hanya JPG, PNG.');
        }

        if ($_FILES["lampiran"]["size"] > $max_size) {
            showAlert('❌ Ukuran file terlalu besar. Maksimal 5MB.');
        }

        $fileName = strtolower(str_replace(" ", "_", $nama)) . "_" . time() . "." . $ext;
        $uploadPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES["lampiran"]["tmp_name"], $uploadPath)) {
            showAlert('❌ Gagal mengunggah file.');
        }
    }

    $query = "INSERT INTO ulasan (nama, status, rating, ulasan, tanggal, lampiran) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisss", $nama, $status, $rating, $ulasan, $tanggal, $fileName);

    if ($stmt->execute()) {
        showAlert('✅ Data berhasil disimpan');
    } else {
        showAlert('❌ Terjadi kesalahan!');
    }

    $stmt->close();
    $check_stmt->close();
    $conn->close();
}

function showAlert($message)
{
    echo "<script type='text/javascript'>
            alert('$message');
          </script>";
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Company Profile Real Estate Ciamis Jawa Barat">
    <meta name="keywords" content="Company Profile Real Estate">
    <meta name="author" content="Company Profile Real Estate">
    <title>Company Profile Real Estate</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- favicons -->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <!-- css -->
    <link rel="stylesheet" href="css/ulasan.css">
</head>

<body>
    <main>
        <!-- navbar -->
        <header>
            <figure>
                <img src="img/logo.png" alt="dtr">
                <figcaption>DANDY TR</figcaption>
            </figure>
            <nav>
                <ul>
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#properties">Properties</a></li>
                    <li><a href="index.php#about">About Us</a></li>
                    <li><a href="index.php#investor">Investor</a></li>
                    <li><a href="index.php#news">News</a></li>
                    <li><a href="index.php#testimonial">Testimonial</a></li>
                </ul>
            </nav>

            <div class="contact">
                <a href="index.php#contact-us">Contact Us</a>
            </div>

            <button id="hamburger" aria-label="Menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </button>
        </header>
        <!-- navbar -->

        <section id="buat-ulasan">
            <h2>BUAT ULASAN</h2>
            <form action="ulasan.php" method="post" id="form-ulasan" enctype="multipart/form-data">
                <div class="form-flex">
                    <div class="nama">
                        <label for="nama">Username</label>
                        <input type="text" id="nama" name="nama" placeholder="Contoh: dandy_123" maxlength="20"
                            required>
                    </div>
                    <div class="status">
                        <label for="status">Status</label>
                        <select name="status" id="status" required>
                            <option value="" disabled selected hidden>Pilih Status Anda</option>
                            <option value="Pemilik Rumah">Pemilik Rumah</option>
                            <option value="Penyewa Rumah atau Villa">Penyewa Rumah atau Villa</option>
                            <option value="Investor">Investor</option>
                        </select>
                    </div>
                </div>
                <label for="rating">Rating</label>
                <div class="bintang">
                    <i class="fa-regular fa-star" data-value="1"></i>
                    <i class="fa-regular fa-star" data-value="2"></i>
                    <i class="fa-regular fa-star" data-value="3"></i>
                    <i class="fa-regular fa-star" data-value="4"></i>
                    <i class="fa-regular fa-star" data-value="5"></i>
                    <span class="caption-rating">Beri Rating 1 - 5</span>
                    <input type="hidden" id="rating" name="rating">
                </div>
                <label for="isi-ulasan">Ulasan</label>
                <textarea name="isi-ulasan" id="isi-ulasan" cols="40" rows="4" placeholder="Isi Ulasan Anda"
                    maxlength="550" required></textarea>
                <label for="lampiran">Lampirkan Foto</label>

                <div class="upload-foto">

                    <i class="fa-solid fa-file-image"></i>
                    <p>Drag and Drop files here or <span id="chooseFile">Choose File</span></p>
                    <small>Maximum size: 5MB</small>

                    <input type="file" id="lampiran" name="lampiran" accept="image/*" multiple hidden>

                    <div id="fileList"></div>
                </div>
                <button id="submit" type="submit" aria-label="submit">Kirim Ulasan</button>
            </form>
        </section>
    </main>

    <!-- javascript -->
    <script src="js/ulasan.js"></script>
    <!-- javascript -->
</body>

</html>