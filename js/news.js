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
