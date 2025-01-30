<?php
// Sertakan koneksi database
require 'koneksi.php';

// Ambil data properti dari database
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);

$news = "SELECT * FROM news LIMIT 3";
$hasilNews = $conn->query($news);

$ulasan = "SELECT * FROM ulasan LIMIT 4";
$hasilUlasan = $conn->query($ulasan);


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
    <link rel="stylesheet" href="css/style.css">
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
                <li><a class="active" href="#home">Home</a></li>
                <li><a href="#properties">Properties</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#investor">Investor</a></li>
                <li><a href="#news">News</a></li>
                <li><a href="#testimonial">Testimonial</a></li>
            </ul>
        </nav>

        <div class="contact">
            <a href="#contact-us">Contact Us</a>
        </div>

        <button id="hamburger" aria-label="Menu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </button>
    </header>
    <!-- navbar -->

    <main>
        <!-- home page -->
        <section id="home">
            <article>
                <h2>KAMI MEMBANTU ANDA MENEMUKAN RUMAH IMPIAN</h2>
                <p>Dengan jaringan luas dan pengalaman bertahun - tahun, kami hadir untuk membantu Anda menemukan
                    properti
                    impian dengan cepat dan aman. Solusi lengkap untuk kebutuhan real estate Anda
                    <a class="btn-selengkapnya" href="#properties">SELENGKAPNYA</a>
                </p>
                <div class="rtg-home">4.9/5 <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
            </article>
            <div class="wadah-gambar">
                <h1>REAL ESTATE<br><span>PROPERTY</span></h1>
                <div class="gambar"></div>
            </div>
            <div class="layanan">
                <h2>LAYANAN KAMI</h2>
                <div class="isi-layanan">
                    <p><img class="img-layanan" src="svg/lyn-1.svg" alt="layanan 1">Jual Properti</p>
                    <p><img class="img-layanan" src="svg/lyn-2.svg" alt="layanan 1">Sewa Properti</p>
                    <p><img class="img-layanan" src="svg/lyn-3.svg" alt="layanan 1">Konsultasi Properti</p>
                </div>
            </div>
        </section>
        <!-- home page -->

        <!-- mouse scroll -->
        <div class="mouse-scroll">
            <div class="mouse">
                <div class="mouse-wheel">
                    <div class="scroll"></div>
                </div>
            </div>
            <p>Scroll</p>
        </div>
        <!-- mouse scroll -->

        <!-- properties -->
        <section id="properties">
            <h2>PROPERTIES</h2>
            <div id="wadah-pr">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $token = base64_encode($row['id_properti'] . 'SECRET_KEY'); // Encode ID
                
                        echo '<figure class="figure-pr">
                            <div class="wdh-img-pr">
                                <img class="img-pr" src="img/' . htmlspecialchars($row['gambar']) . '" alt="property img">
                            </div>
                            <div class="deskripsi-pr">
                                <figcaption class="caption-pr">
                                    <h3>' . htmlspecialchars($row['judul']) . '</h3>
                                    <p>' . htmlspecialchars($row['ket_awal']) . '</p>
                                </figcaption>

                                <div class="fasilitas">
                                    <p><img class="svg-pr" src="svg/rumah.svg" alt="rumah svg">' . htmlspecialchars($row['status']) . '</p>
                                    <p><img class="svg-pr" src="svg/kasur.svg" alt="kasur svg">' . htmlspecialchars($row['kamar_tidur']) . '</p>
                                    <p><i class="fa-solid fa-location-dot"></i>' . htmlspecialchars($row['lokasi_awal']) . '</p>
                                    <p class="status">' . htmlspecialchars($row['keadaan']) . '</p>
                                    <p><i class="fa-solid fa-shower"></i>' . htmlspecialchars($row['kamar_mandi']) . '</p>
                                    <p><i class="fa-solid fa-money-bill"></i>Rp' . htmlspecialchars($row['harga']) . '</p>
                                    <p class="rtg-pr">' . htmlspecialchars($row['rating']) . ' <span>&#9733;</span></p>
                                    <p><img class="svg-pr" src="svg/tangga.svg" alt="tangga svg">' . htmlspecialchars($row['lantai']) . '</p>
                                    <p><i class="fa-solid fa-arrows-left-right-to-line"></i>' . htmlspecialchars($row['luas_tanah']) . '</p>
                                </div>

                                <a id="lihat-dtl-pr" href="detail.php?token=' . urlencode($token) . '">Lihat Detail</a>
                            </div>
                        </figure>';

                    }
                } else {
                    echo "<p>Tidak ada properti yang tersedia.</p>";
                }
                ?>

            </div>
        </section>
        <!-- properties -->

        <!-- about us -->
        <section id="about">
            <h2>ABOUT US</h2>
            <article id="article-about">
                <p class="deskripsi-about">Dandy Tr Company adalah perusahaan real estate yang didirikan pada tahun 2004
                    di
                    Ciamis, kami lahir dari keinginan untuk mempermudah masyarakat dalam menemukan rumah idaman mereka.
                    Kami melihat kesenjangan antara
                    kebutuhan pelanggan dan aksesibilitas informasi properti yang lengkap, sehingga kami hadir sebagai
                    solusi terpercaya.</p>
                <div class="isi-about">
                    <div class="visi">
                        <h3>Visi Perusahaan</h3>
                        <p>Kami memiliki visi untuk menjadi platform real estate terdepan di Indonesia yang tidak
                            hanya menyediakan akses mudah dan terpercaya ke berbagai jenis properti, tetapi
                            juga mengubah cara masyarakat melihat dan berinteraksi dengan pasar properti.
                            Dengan fokus pada inovasi teknologi, kepercayaan pelanggan, dan
                            keberlanjutan, kami berupaya menciptakan ekosistem properti
                            yang modern, efisien, dan inklusif, di mana setiap orang dapat
                            menemukan rumah atau investasi yang sesuai
                            dengan kebutuhan dan impian mereka.</p>
                    </div>
                    <div class="nilai">
                        <p><img src="svg/aboutsertifikat.svg" alt="terpercaya">Terpercaya</p>
                        <p><img src="svg/aboutinovasi.svg" alt="inovatif">Inovatif</p>
                        <p><img src="svg/abouttranparansi.svg" alt="transparansi">Transparansi</p>
                        <p><img src="svg/aboutpelanggan.svg" alt="pelanggan">Kepuasan<br>Pelanggan</p>
                    </div>
                    <div class="misi">
                        <h3>Misi Perusahaan</h3>
                        <p>Kami berkomitmen memberikan pengalaman terbaik kepada setiap pelanggan, mulai
                            dari pencarian hingga transaksi akhir. Kami terus mengembangkan platform digital
                            kami untuk menawarkan fitur-fitur canggih seperti pencarian berbasis lokasi, tur
                            virtual, dan rekomendasi yang dipersonalisasi. Sebagai bagian dari tanggung
                            jawab kami terhadap lingkungan dan komunitas, kami berusaha
                            mempromosikan praktik pembangunan yang berkelanjutan
                            dan memberikan edukasi kepada pelanggan tentang
                            pentingnya memilih properti yang ramah lingkungan.</p>
                    </div>
                </div>
            </article>
            <div class="gambar-about">
                <p>Contact Us<a href="#contact-us"><i class="fa-solid fa-angle-down"></i></a></p>
            </div>
        </section>
        <!-- about us -->

        <!-- investor -->
        <section id="investor">
            <h2>INVESTOR</h2>
            <div class="investor-content">
                <article id="article-investor">
                    <h3>Bergabunglah dengan Kami dalam Membentuk Masa Depan Real Estate di Indonesia</h3>
                    <p class="deskripsi-investor">Sebagai salah satu pelaku utama di industri real estate Indonesia,
                        kami berkomitmen untuk
                        menciptakan nilai yang berkelanjutan bagi para pemegang saham dan mitra
                        investasi kami. Dengan pendekatan yang berfokus pada inovasi, transparansi, dan keberlanjutan,
                        kami berupaya memberikan pengalaman investasi yang aman dan
                        menjanjikan. Melalui pengelolaan yang profesional dan strategi pertumbuhan yang solid, kami
                        telah membangun reputasi sebagai perusahaan yang dapat dipercaya
                        di pasar properti. Halaman ini dirancang khusus untuk memberikan Anda akses langsung ke laporan
                        keuangan, kinerja perusahaan, serta visi strategis kami ke depan.
                        Bersama-sama, kita bangun masa depan real estate yang lebih cerah dan bermakna.</p>
                    <h4>Pemegang Saham</h4>
                    <div class="saham">
                        <p><img src="svg/invstor.svg" alt="investor">PT Unigal
                            Asset Management <span>40%</span></p>
                        <p><img src="svg/invstor.svg" alt="investor">Dandy Tr
                            (Pendiri Perusahaan) <span>25%</span></p>
                        <p><img src="svg/invstor.svg" alt="investor">Saham Publik
                            (Investor Individu) <span>20%</span></p>
                        <p><img src="svg/invstor.svg" alt="investor">Anggota Manajemen
                            (Gabungan) <span>15%</span></p>
                    </div>
                </article>

                <figure id="figure-investor">
                    <div class="gambar-investor">
                    </div>
                    <figcaption id="caption-investor">
                        <h4>Unduh Laporan</h4>
                        <div class="laporan">
                            <a href="img/laporan.pdf" download="img/laporan.pdf">Laporan Tahunan 2023</a>
                            <a href="img/laporan.pdf" download="img/laporan.pdf">Laporan Tahunan 2022</a>
                            <a href="img/laporan.pdf" download="img/laporan.pdf">Laporan Kuartal 1 2024</a>
                            <a href="img/laporan.pdf" download="img/laporan.pdf">Laporan Kuartal 4 2023</a>
                            <a class="hide" href="img/laporan.pdf" download="img/laporan.pdf">Laporan Kuartal 4 2023</a>
                            <a class="hide" href="img/laporan.pdf" download="img/laporan.pdf">Laporan Kuartal 4 2023</a>
                        </div>
                        <button id="lihat-laporan" aria-label="lihat laporan"><i
                                class="fa-solid fa-angles-down"></i></button>
                    </figcaption>
                </figure>
            </div>
        </section>
        <!-- investor -->

        <!-- news -->
        <section id="news">
            <h2>NEWS</h2>
            <?php
            if ($hasilNews->num_rows > 0) {
                while ($baris = $hasilNews->fetch_assoc()) {
                    $token = base64_encode($baris['id_news'] . 'SECRET_KEY'); // Encode ID
            
                    echo '<article class="article-news">
                <figure class="figure-news">
                    <div class="wadah-img-news">
                        <img src="img/' . htmlspecialchars($baris['gambar']) . ' " alt="news">
                        <figcaption class="waktu-news">' . htmlspecialchars($baris['waktu']) . '</figcaption>
                    </div>
                </figure>
                <div class="detail-news">
                    <h3>' . htmlspecialchars($baris['judul']) . '</h3>
                    <p>' . htmlspecialchars($baris['ket_awal']) . '
                        <span>' . htmlspecialchars($baris['nilai']) . '</span>
                    </p>
                    <a class="baca-selengkapnya" href="news.php?token=' . urlencode($token) . '">Baca Selengkapnya</a>
                </div>
            </article>';
                }

            } else {
                echo "<p> Tidak ada data </p>";
            }
            ?>
        </section>
        <!-- news -->

        <!-- testimonial -->
        <section id="testimonial">
            <h2>TESTIMONIAL</h2>
            <div class="testi-flex">
                <div class="buat-ulasan">
                    <h3>Apa Kata Klien Kami?</h3>
                    <a class="btn-ulasan" href="ulasan.php">Buat Ulasan</a>
                    <div class="arrow-testi">
                        <button id="prev-testi" aria-label="prev-testi"><i class="fa-solid fa-angle-left"></i></button>
                        <button id="next-testi" aria-label="next-testi"><i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </div>
                <div class="wadah-testi">
                    <div class="wadah-card-testi">
                        <?php
                        if ($hasilUlasan->num_rows > 0) {
                            while ($row = $hasilUlasan->fetch_assoc()) {  // Pastikan variabel yang digunakan benar
                                echo '<div class="card-testi">
                <div class="rating-testi">';

                                // ⭐ Menampilkan bintang sesuai rating
                                for ($i = 0; $i < $row['rating']; $i++) {
                                    echo '<p>&#9733;</p>';  // Bintang penuh (★)
                                }

                                // ☆ Menampilkan bintang kosong jika rating < 5
                                for ($i = $row['rating']; $i < 5; $i++) {
                                    echo '<p>&#9734;</p>';  // Bintang kosong (☆)
                                }

                                echo '</div>
                <p class="waktu-testi">' . htmlspecialchars($row['tanggal']) . '</p>
                <p class="isi-testi">' . htmlspecialchars($row['ulasan']) . '</p>
                <div class="bawah-card-testi">
                    <p class="nama-testi">@' . htmlspecialchars($row['nama']) . '</p>
                    <p class="status-testi">' . htmlspecialchars($row['status']) . '</p>
                </div>
            </div>';
                            }
                        } else {
                            echo "<p> Tidak ada data </p>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial -->

        <!-- contact us -->
        <section id="contact-us">
            <h2>CONTACT US</h2>
            <div class="wadah-contact">
                <form action="" method="post" id="form-contact">
                    <h3>Kirim Pesan Kepada Kami</h3>
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Isi Nama Lengkap" required>
                    <div class="contact-flex">

                        <div class="email">
                            <label for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" placeholder="Isi Email" required>
                        </div>

                        <div class="telepon">
                            <label for="telepon">No Telepon</label>
                            <input type="tel" id="telepon" name="telepon" pattern="[0-9]{10,13}"
                                placeholder="Isi No Telepon" required>
                        </div>
                    </div>

                    <label for="subjek">Subjek</label>
                    <input type="text" id="subjek" name="subjek" placeholder="Contoh: Permintaan Informasi Proyek Baru"
                        required>

                    <label for="pesan">Isi Pesan</label>
                    <textarea id="pesan" name="pesan" rows="7" cols="50" placeholder="Isi detail permintaan anda"
                        required></textarea>

                    <button id="submit" type="submit" aria-label="submit">Kirim</button>

                </form>



                <div class="lokasi-peta">
                    <h4 class="judul-contact">Kami siap membantu Anda menemukan properti impian
                        atau menjawab segala pertanyaan Anda. Hubungi kami
                        melalui cara yang paling nyaman untuk Anda.</h4>
                    <p class="lokasi-contact">Lokasi Kantor kami</p>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15829.289220500661!2d108.38569445!3d-7.317644949999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5e7c814cd4d7%3A0x1776f1dbcacbfe13!2sUtama%2C%20Kec.%20Cijeungjing%2C%20Kabupaten%20Ciamis%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1738050956771!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </section>
        <!-- contact us -->

        <!-- footer -->
        <footer id="footer">
            <div class="isi-footer">
                <figure class="figure-footer">
                    <img src="img/logo.png" alt="dtr">
                    <figcaption class="caption-footer">
                        <h5>DANDY TR COMPANY</h5>
                        <p>adalah perusahaan real estate terpercaya di
                            Indonesia, berkomitmen membantu Anda
                            menemukan properti impian, investasi
                            menguntungkan, atau solusi properti terbaik.
                            Dengan layanan profesional dan portofolio
                            properti berkualitas, kami hadir untuk memenuhi
                            kebutuhan Anda dengan mudah, aman, dan
                            terpercaya.</p>
                    </figcaption>
                </figure>
                <div class="navigation">
                    <h5>NAVIGATION</h5>
                    <a href="#home">Home</a>
                    <a href="#properties">Properties</a>
                    <a href="#about">About Us</a>
                    <a href="#investor">Investor</a>
                    <a href="#news">News</a>
                    <a href="#testimonial">Testimonial</a>
                    <a href="#contact-us">Contact Us</a>
                </div>
                <div class="our-service">
                    <h5>OUR SERVICE</h5>
                    <p>Pembelian Properti</p>
                    <p>Penjualan Properti</p>
                    <p>Sewa Properti</p>
                    <p>Konsultasi Properti</p>
                    <p>Investasi</p>
                </div>
                <div class="follow-us">
                    <h5>FOLLOW US</h5>

                    <div class="sosmed-footer">
                        <a href="https://www.tiktok.com/@dndy_tr?_t=8pGlBIxd2VF&_r=1" target="_blank"><i
                                class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/dndy_tr?igsh=MXZqYmRoNnRoNHRubg==" target="_blank"><i
                                class="fa-brands fa-square-instagram"></i></a>
                        <a href="https://id.linkedin.com/in/dandy-taufiqurrochman-8b5106293" target="_blank"><i
                                class="fa-brands fa-linkedin" target="_blank"></i></a>
                        <a href="https://www.threads.net/@dndy_tr" target="_blank"><i
                                class="fa-brands fa-square-threads"></i></a>
                    </div>

                    <div class="emailphone-footer">
                        <h5>EMAIL AND PHONE</h5>
                        <p><i class="fa-solid fa-envelope"></i>dandy.taufiqurrochman@gmail.com</p>
                        <p><i class="fa-solid fa-phone"></i>+62 858-6022-3835</p>
                    </div>

                </div>
                <div class="newsletter">
                    <h5>NEWSLETTER</h5>
                    <p>Dapatkan Berita dan Penawaran Terbaru</p>
                    <input type="email" id="email-newsletter" name="email-newsletter"
                        placeholder="✉️ Masukkan Email Anda" required>
                    <button id="submit-newsletter" type="submit" aria-label="submit">Subscribe</button>
                </div>
            </div>
            <hr>
            <p id="copyright-footer">COPYRIGHT &copy; 2025 | CREATED BY DANDY TR</p>
        </footer>
        <!-- footer -->
    </main>

    <!-- javascript -->
    <script src="js/script.js"></script>
    <!-- javascript -->
</body>

</html>