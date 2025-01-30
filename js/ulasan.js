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

// klik bintang
const stars = document.querySelectorAll(".bintang i");
let selectedRating = 0;
const ratingInput = document.querySelector("#rating");

stars.forEach((star) => {
  star.addEventListener("click", function () {
    selectedRating = this.getAttribute("data-value");
    ratingInput.value = selectedRating;
    setRating(selectedRating);
  });
});

function highlightStars(count) {
  for (let i = 0; i < count; i++) {
    stars[i].classList.add("active");
    stars[i].classList.replace("fa-regular", "fa-solid");
  }
}

function resetStars() {
  stars.forEach((star) => {
    star.classList.remove("active");
    star.classList.replace("fa-solid", "fa-regular");
  });
}

function setRating(rating) {
  resetStars();
  highlightStars(rating);
}
// klik bintang end

// tambah gambar
const fileInput = document.querySelector("#lampiran");
const dropArea = document.querySelector(".upload-foto");
const chooseFile = document.querySelector("#chooseFile");
const fileList = document.querySelector("#fileList");

const imageIcon = document.querySelector(".upload-foto i");

const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB, maksimal file yang dapat diupload
const ALLOWED_TYPES = ["image/png", "image/jpeg", "image/jpg"];

// Event saat file dipilih
fileInput.addEventListener("change", (event) => tambahFile(event));

// Saat klik "Choose File", buka file explorer
chooseFile.addEventListener("click", (event) => {
  event.stopPropagation();
  fileInput.value = "";
  fileInput.click();
});
dropArea.addEventListener("click", (event) => {
  event.stopPropagation();
  fileInput.value = "";
  fileInput.click();
});

// Fungsi menambahkan file ke daftar
function tambahFile(event) {
  fileList.innerHTML = ""; // Kosongkan daftar sebelum menampilkan yang baru

  const files = event.target.files;
  const dt = new DataTransfer(); // Untuk menyimpan file yang sudah diproses

  if (files.length > 0) {
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const fileName = file.name.toLowerCase(); // Ubah nama file jadi huruf kecil

      fileList.innerHTML = `✅<span>${files[i].name}</span>`;

      dropArea.style.backgroundColor = "var(--warna-abu7)";
      dropArea.style.borderColor = "white";
      dropArea.style.color = "white";
      imageIcon.style.color = "white";

      if (files[i].size > MAX_FILE_SIZE) {
        fileList.innerHTML = `❌<span>${files[i].name} terlalu besar! Maksimum 5MB.</span>`;
        return; // Lewati file yang terlalu besar
      }

      if (!ALLOWED_TYPES.includes(files[i].type)) {
        fileList.innerHTML = `❌<span>${files[i].name} bukan gambar! Hanya gambar diperbolehkan.</span>`;
        return;
      }

      // Buat file baru dengan nama yang sudah dikonversi menjadi lowercase
      const newFile = new File([file], fileName, { type: file.type });

      dt.items.add(newFile); // Tambahkan file yang sudah diubah namanya
    }
  }
  fileInput.files = dt.files;
}

// Menangani drag and drop file
dropArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  dropArea.style.borderColor = "white";
  dropArea.style.backgroundColor = "var(--warna-abu7)";
  dropArea.style.color = "white";
  imageIcon.style.color = "white";
});

dropArea.addEventListener("dragleave", (e) => {
  e.preventDefault();
  dropArea.style.borderColor = "var(--warna-abu6)";
  dropArea.style.backgroundColor = "black";
  dropArea.style.color = "var(--warna-abu6)";
  imageIcon.style.color = "var(--warna-abu6)";
});

dropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  dropArea.style.borderColor = "white";
  dropArea.style.color = "white";
  imageIcon.style.color = "white";
  dropArea.style.backgroundColor = "var(--warna-abu7)";

  fileInput.files = e.dataTransfer.files; // Masukkan file ke input
  tambahFile({ target: fileInput }); // Tampilkan daftar file
});
// tambah gambar end

// tidak kosong
const inputs = [
  {
    id: "nama",
    message: "Username harus diisi",
  },
  {
    id: "isi-ulasan",
    message: "Ulasan harus diisi",
  },
];

const selectedStatus = document.querySelector("#status");

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

const form = document.querySelector("#form-ulasan");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  if (
    selectedStatus.value === "" ||
    selectedRating === 0 ||
    fileInput.files.length === 0
  ) {
    alert("❗Silahkan isi semua field");
    return;
  }

  const formData = new FormData(form);

  // Kirim data ke PHP via Fetch API
  fetch("ulasan.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      // Reset form setelah sukses
      form.reset(); // Reset form
      document.getElementById("rating").value = "0"; // Reset ratingyyyy
    })
    .catch((error) => console.error("Error:", error));
});
