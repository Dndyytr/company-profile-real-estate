<?php
require 'koneksi.php';

if (isset($_GET['token'])) {
    $decoded = base64_decode($_GET['token']);
    list($id, $key) = explode('SECRET_KEY', $decoded);

    if (is_numeric($id)) {
        $sql = "SELECT * FROM news WHERE id_news = ?";
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


// Mendapatkan URL halaman saat ini secara otomatis
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$currentUrl = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

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
    <link rel="stylesheet" href="css/news.css">
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

    <main>
        <section id="news-detail">
            <article class="article-news">
                <figure class="figure-news">
                    <img src="img/<?php echo htmlspecialchars($row['gambar']); ?>" alt="news">
                </figure>
                <h2><?php echo htmlspecialchars($row['judul']); ?></h2>
                <p><?php echo htmlspecialchars($row['ket_detail1']); ?></p>
                <p><?php echo htmlspecialchars($row['ket_detail2']); ?></p>
                <p><?php echo htmlspecialchars($row['ket_detail3']); ?></p>
                <p><?php echo htmlspecialchars($row['ket_detail4']); ?></p>
                <p><?php echo htmlspecialchars($row['ket_detail5']); ?></p>
            </article>
            <aside class="aside-news">
                <div class="informasi">
                    <h3>Meta Information</h3>
                    <p><i class="fa-solid fa-calendar-days"></i><?php echo htmlspecialchars($row['waktu']); ?></p>
                    <p><i class="fa-solid fa-pen"></i>Admin Dandy Tr Company</p>
                    <p><i class="fa-solid fa-list"></i><?php echo htmlspecialchars($row['tipe']); ?></p>
                    <p><i class="fa-regular fa-eye"></i>Dilihat <?php echo htmlspecialchars($row['penonton']); ?> Kali
                    </p>
                </div>
                <div class="share">
                    <h3>Share</h3>
                    <div class="sosmed">
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($currentUrl); ?>&text=Bagikan%20halaman%20ini!"
                            target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($currentUrl); ?>"
                            target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
                        <a href="https://wa.me/?text=Bagikan%20halaman%20ini:%20<?php echo urlencode($currentUrl); ?>"
                            target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href=""><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($currentUrl); ?>"
                            target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="rekomendasi">
                    <h3>Recomendation</h3>
                    <div class="wadah-rekomendasi">
                        <figure>
                            <img src="img/news1.jpg" alt="news">
                        </figure>
                        <figure>
                            <img src="img/news1.jpg" alt="news">
                        </figure>
                        <figure>
                            <img src="img/news1.jpg" alt="news">
                        </figure>
                        <figure>
                            <img src="img/news1.jpg" alt="news">
                        </figure>
                        <figure>
                            <img src="img/news1.jpg" alt="news">
                        </figure>
                        <figure>
                            <img src="img/news1.jpg" alt="news">
                        </figure>
                    </div>
                </div>
            </aside>
        </section>
    </main>

    <!-- javascript -->
    <script src="js/news.js"></script>
    <!-- javascript -->

</body>

</html>