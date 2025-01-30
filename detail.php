<?php
require 'koneksi.php';

if (isset($_GET['token'])) {
    $decoded = base64_decode($_GET['token']);
    list($id, $key) = explode('SECRET_KEY', $decoded);

    if (is_numeric($id)) {
        $sql = "SELECT * FROM properties WHERE id_properti = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>Properti tidak ditemukan.</p>";
            exit;
        }
    } else {
        echo "<p>Token tidak valid.</p>";
        exit;
    }
} else {
    echo "<p>Token tidak ditemukan.</p>";
    exit;
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
    <link rel="stylesheet" href="css/detail.css">
</head>

<body>
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

    <!-- main -->
    <main>
        <section id="detail-pr">

            <div class="wadah-dtl">

                <div class="detail-1">
                    <figure class="figure-dtl">
                        <div class="wadah-img">
                            <img src="img/<?php echo htmlspecialchars($row['gambar']); ?>" alt="gambar detail 1">
                            <img src="img/ruangtamu.jpg" alt="ruang tamu">
                            <img src="img/dapur.jpg" alt="dapur">
                            <img src="img/kamarmandi.jpg" alt="kamar mandi">
                        </div>
                        <button id="next" aria-label="next"><i class="fa-solid fa-angle-left"></i></button>
                        <button id="prev" aria-label="prev"><i class="fa-solid fa-angle-right"></i></button>
                    </figure>
                    <figcaption class="caption-dtl">
                        <h2><?php echo htmlspecialchars($row['judul']); ?></h2>
                        <p class="harga"><i class="fa-solid fa-money-bill"></i>
                            Rp<?php echo htmlspecialchars($row['harga']); ?></p>
                        <p class="lokasi"><i
                                class="fa-solid fa-location-dot"></i><?php echo htmlspecialchars($row['lokasi']); ?></p>
                        <p class="status"><?php echo htmlspecialchars($row['status']); ?></p>
                    </figcaption>
                </div>

                <div class="detail-2">
                    <h3>Tentang Properti Ini</h3>
                    <p class="ket_detail"><?php echo htmlspecialchars($row['ket_detail']); ?></p>
                    <div class="fasilitas">
                        <p class="luas_bangunan"><img src="svg/gedung.svg" alt="gedung">
                            <?php echo htmlspecialchars($row['luas_bangunan']); ?> Luas Bangunan</p>
                        <p class="luas_tanah"><i class="fa-solid fa-arrows-left-right-to-line"></i>
                            <?php echo htmlspecialchars($row['luas_tanah']); ?> Luas Tanah</p>
                        <p class="kamar_tidur"><img src="svg/kasur.svg"
                                alt="kasur"><?php echo htmlspecialchars($row['kamar_tidur']); ?>
                        </p>
                        <p class="kamar_mandi"><i class="fa-solid fa-shower"></i>
                            <?php echo htmlspecialchars($row['kamar_mandi']); ?></p>
                        <p class="dapur"><img src="svg/dapur.svg" alt="dapur">
                            <?php echo htmlspecialchars($row['dapur']); ?></p>
                        <p class="parkiran"><img src="svg/parkir.svg" alt="parkiran">
                            <?php echo htmlspecialchars($row['parkiran']); ?>
                        </p>
                        <p class="sertifikat"><img src="svg/sertifikats.svg" alt="sertifikat">
                            <?php echo htmlspecialchars($row['sertifikat']); ?></p>
                        <p class="lainnya"><img src="svg/lainnya.svg" alt="lainnya">
                            <?php echo htmlspecialchars($row['fasilitas_lain']); ?></p>
                    </div>

                    <form action="" method="get" id="form-dtl">

                        <div class="form-flex">
                            <div class="nama">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" placeholder="Isi Nama Lengkap" required>
                            </div>
                            <div class="telepon">
                                <label for="telepon">No Telepon</label>
                                <input type="tel" id="telepon" name="telepon" pattern="[0-9]{10,13}"
                                    placeholder="Isi No Telepon" required>
                            </div>
                        </div>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Isi Email" required>

                        <label for="pesan">Pesan</label>
                        <textarea id="pesan" name="pesan" rows="4" cols="40" placeholder="Isi detail permintaan anda"
                            required></textarea>

                        <button id="submit" type="submit" aria-label="submit"
                            data-nama="<?php echo htmlspecialchars($row['judul']); ?>"
                            data-harga="<?php echo htmlspecialchars($row['harga']); ?>">Kirim</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- main -->

    <!-- javascript -->
    <script src="js/detail.js"></script>
    <!-- javascript -->
</body>

</html>