// navbar klik
const navbarIsi = document.querySelectorAll("nav ul li a");
navbarIsi.forEach((item) => {
  item.addEventListener("click", () => {
    navbarIsi.forEach((navItem) => navItem.classList.remove("active"));
    item.classList.add("active");
  });
});
// nabar klik end

// navbar transparet
const header = document.querySelector("header");
let lastScrollY = 0;
let tickingHeader = false;

function handleScrollHeader() {
  const shouldApplyStyle = window.scrollY > 5;

  if (shouldApplyStyle !== lastScrollY) {
    if (shouldApplyStyle) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
    lastScrollY = shouldApplyStyle;
  }

  tickingHeader = false;
}
// navbar transparet end

// hamburger menu
const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("header nav ul");
hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
});

// klik diluar navmenu
document.addEventListener("click", (e) => {
  if (
    !hamburger.contains(e.target) &&
    !navMenu.contains(e.target) &&
    navMenu.classList.contains("active")
  ) {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
  }
});
// hamburger menu end

// mouse hide
const mouse = document.querySelector(".mouse-scroll");
window.addEventListener("scroll", () => {
  window.scrollY > 55
    ? mouse.classList.add("mouse-hide")
    : mouse.classList.remove("mouse-hide");
});
// mouse hide end

// parallax home
const article = document.querySelector("#home article");
const articleH2 = document.querySelector("#home article h2");
const articleRTG = document.querySelector("#home article .rtg-home");

const gambarH1 = document.querySelector("#home .wadah-gambar h1");

const layanan = document.querySelector("#home .layanan");
const layananH2 = document.querySelector("#home .layanan h2");
const isiLayananP = document.querySelectorAll("#home .layanan .isi-layanan p");

let ticking = false;

function handleScroll() {
  let scroll = window.scrollY / 300;

  if (scroll <= 0.55) {
    // Simpan transform dalam variabel
    let articleScale = `scale(${1 + scroll * 1.2})`;
    let articleTranslateX = `translateX(${-(scroll * 140)}px)`;
    let blurEffect = `blur(${scroll * 7.3}px)`;

    let gambarTranslateY = `translateY(${scroll * 175}px)`;

    let layananScale = `scale(${1 + scroll})`;
    let layananTranslateX = `translateX(${scroll * 200}px)`;

    // Terapkan transform dalam satu batch
    article.style.transform = articleScale;
    articleH2.style.transform = articleTranslateX;
    articleRTG.style.transform = articleTranslateX;
    article.style.filter = blurEffect;

    gambarH1.style.transform = gambarTranslateY;

    layanan.style.transform = layananScale;
    layananH2.style.transform = layananTranslateX;
    layanan.style.filter = blurEffect;

    // Transformasi untuk isiLayananP
    let totalP = isiLayananP.length;
    isiLayananP.forEach((p, index) => {
      let faktor =
        index === 0 || index === totalP - 1 ? 1 : 0.5 + (index / totalP) * 1;
      p.style.transform = `translateX(${scroll * 100 * faktor}px)`;
    });
  }

  ticking = false;
}

window.addEventListener("scroll", () => {
  if (!ticking || !tickingHeader) {
    requestAnimationFrame(handleScrollHeader);
    requestAnimationFrame(handleScroll);
    ticking = true;
    tickingHeader = true;
  }
});
// parallax home end

// klik properties
const properties = document.querySelectorAll(".figure-pr");

properties.forEach((item) => {
  item.addEventListener("click", () => {
    // Cek apakah item sudah memiliki class 'active'
    item.classList.contains("active")
      ? item.classList.remove("active") // Jika sudah, hapus class 'active'
      : (properties.forEach((pr) => pr.classList.remove("active")),
        item.classList.add("active")); // Jika belum, hapus dari semua elemen lain dan tambahkan ke elemen yang diklik
  });
});
// klik properties end

// parallax about
const elements = document.querySelectorAll(
  ".deskripsi-about, .visi p, .misi p, #investor .investor-content #article-investor h3, #investor .investor-content #article-investor .deskripsi-investor, #news .article-news .detail-news h3, #news .article-news .detail-news p, #testimonial .testi-flex .buat-ulasan h3, #contact-us .wadah-contact .lokasi-peta h4"
);

const speedFactor = 2.2; // Bisa diubah untuk menyesuaikan kecepatan
const startPoint = 0; // Mulai efek saat elemen 20% dalam viewport
const endPoint = 0.75; // Opacity penuh saat elemen 80% dalam viewport

const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const updateOpacity = () => {
          let rect = entry.target.getBoundingClientRect();
          let viewportHeight = window.innerHeight;

          // Hitung posisi relatif elemen dalam viewport (0 = atas, 1 = bawah)
          let progress = rect.top / viewportHeight;

          // Normalisasi progress berdasarkan startPoint dan endPoint
          let opacityProgress =
            (1 - progress - startPoint) / (endPoint - startPoint);

          // Terapkan speedFactor & batasi rentang opacity antara 0 - 1
          let nilai = Math.max(0, Math.min(1, opacityProgress * speedFactor));

          entry.target.style.opacity = nilai;
        };

        window.addEventListener("scroll", updateOpacity);
        updateOpacity();
      }
    });
  },
  { threshold: [0, 0.2, 0.5, 0.8, 1] }
);

elements.forEach((element) => observer.observe(element));
// parallax about end

// klik investor
const laporans = document.querySelectorAll(".laporan a");
const btnLihatLaporan = document.querySelector("#lihat-laporan");
const arrowLihatLaporan = document.querySelector("#lihat-laporan i");

btnLihatLaporan.addEventListener("click", () => {
  arrowLihatLaporan.classList.toggle("rotate");
  laporans.forEach((a, i) => {
    if (i >= 4) {
      a.classList.toggle("hide");
    }
  });
});
// klik investor end

// klik ulasan
const wadahCard = document.querySelector(".wadah-card-testi");
const prevTesti = document.querySelector("#prev-testi");
const nextTesti = document.querySelector("#next-testi");
const cardTesti = document.querySelectorAll(".card-testi");

let wadahCardWidth = cardTesti[0].offsetWidth;

function updateCardWidth() {
  wadahCardWidth = cardTesti[0].offsetWidth; // Ambil ukuran terbaru dari gambar
}

window.addEventListener("resize", updateCardWidth);

function nextTestiSlide() {
  updateCardWidth();
  wadahCard.style.transition = "all 0.6s ease-out";
  wadahCard.style.transform = `translateX(-${wadahCardWidth + 16}px)`;

  setTimeout(() => {
    wadahCard.appendChild(wadahCard.firstElementChild);
    wadahCard.style.transition = "none";
    wadahCard.style.transform = "translateX(0)";
  }, 600);
}

function prevTestiSlide() {
  updateCardWidth();
  wadahCard.insertBefore(
    wadahCard.lastElementChild,
    wadahCard.firstElementChild
  ); // Pindahkan elemen terakhir ke depan
  wadahCard.style.transition = "none"; // Matikan transisi sejenak
  wadahCard.style.transform = `translateX(-${wadahCardWidth}px)`; // Geser ke kiri seolah-olah masih di posisi awal

  setTimeout(() => {
    wadahCard.style.transition = "all 0.6s ease-out"; // Aktifkan transisi kembali
    wadahCard.style.transform = "translateX(0)"; // Geser kembali ke posisi semula
  }, 10);
}

nextTesti.addEventListener("click", prevTestiSlide);
prevTesti.addEventListener("click", nextTestiSlide);
// klik ulasan end

// kirim contact
document
  .getElementById("form-contact")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah reload halaman

    // Ambil data dari form
    const formData = new FormData(this);

    const mailtoLink =
      "mailto:dandy.taufiqurrochman@gmail.com" +
      "?subject=" +
      encodeURIComponent(formData.get("subjek")) +
      "&body=" +
      encodeURIComponent(
        "Nama: " +
          formData.get("nama") +
          "\n" +
          "Email: " +
          formData.get("email") +
          "\n" +
          "Telepon: " +
          formData.get("telepon") +
          "\n" +
          "Pesan: " +
          formData.get("pesan")
      );

    window.location.href = mailtoLink;
  });

// validasi input
const inputs = [
  {
    id: "nama",
    message: "Nama lengkap harus diisi",
  },
  {
    id: "telepon",
    message: "Nomor telepon harus diisi dari 10-13 angka",
  },
  {
    id: "email",
    message: "Masukkan alamat email yang valid",
  },
  {
    id: "pesan",
    message: "Pesan tidak boleh kosong",
  },
  {
    id: "subjek",
    message: "Subjek harus diisi",
  },
];

inputs.forEach((input) => {
  const element = document.getElementById(input.id);
  if (element) {
    element.oninvalid = function () {
      this.setCustomValidity(input.message);
    };
    element.oninput = function () {
      this.setCustomValidity("");
    };
  }
});

// kirim contact end
