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

window.addEventListener("scroll", () => {
  if (!tickingHeader) {
    requestAnimationFrame(handleScrollHeader);
    tickingHeader = true;
  }
});
// navbar transparet end

// image prev next
const next = document.querySelector("#next");
const prev = document.querySelector("#prev");
const wadahImg = document.querySelector(".wadah-img");
let translateX = 0;
const maxTranslateX = -300;

next.addEventListener("click", () => {
  translateX = Math.max(translateX - 100, maxTranslateX);
  wadahImg.style.transform = `translateX(${translateX}%)`;
  updateButtonVisibility();
});

prev.addEventListener("click", () => {
  translateX = Math.min(translateX + 100, 0);
  wadahImg.style.transform = `translateX(${translateX}%)`;
  updateButtonVisibility();
});

function updateButtonVisibility() {
  next.style.display = translateX === maxTranslateX ? "none" : "block";
  prev.style.display = translateX !== 0 ? "block" : "none";
}
// image prev next end

// form validation
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
// form validation end

// form submit
const tombolWA = document.getElementById("submit");
document
  .getElementById("form-dtl")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman form secara default

    // Ambil data properti dari tombol
    const namaProperti = tombolWA.getAttribute("data-nama")
      ? tombolWA.getAttribute("data-nama")
      : "Properti";
    const hargaProperti = tombolWA.getAttribute("data-harga")
      ? tombolWA.getAttribute("data-harga")
      : "Tidak diketahui";

    // Ambil nilai dari input
    const nama = document.getElementById("nama").value;
    const telepon = document.getElementById("telepon").value;
    const email = document.getElementById("email").value;
    const pesan = document.getElementById("pesan").value;

    // Nomor WhatsApp tujuan (ganti dengan nomor admin yang dituju)
    const nomorAdmin = "6285860223835"; // Format: 62 untuk kode Indonesia

    // Format pesan yang akan dikirim ke WhatsApp
    const message =
      `Halo, saya tertarik dengan ${namaProperti}, harga Rp ${hargaProperti}.%0A%0A` +
      `*Nama:* ${nama}%0A` +
      `*Telepon:* ${telepon}%0A` +
      `*Email:* ${email}%0A` +
      `*Pesan:* ${pesan}`;

    // Cek apakah pengguna menggunakan perangkat mobile atau desktop menggunakan ternary
    const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
    const whatsappURL = isMobile
      ? `whatsapp://send?phone=${nomorAdmin}&text=${message}`
      : `https://wa.me/${nomorAdmin}?text=${message}`;

    // Redirect ke WhatsApp
    isMobile
      ? (window.location.href = whatsappURL)
      : window.open(whatsappURL, "_blank");
  });
// form submit end
