(function () {
  const year = document.getElementById("year");
  if (year) year.textContent = new Date().getFullYear();

  // Mobile menu
  const navbtn = document.getElementById("navbtn");
  const nav = document.getElementById("nav");
  if (navbtn && nav) {
    navbtn.addEventListener("click", () => {
      const open = nav.classList.toggle("open");
      navbtn.setAttribute("aria-expanded", open ? "true" : "false");
    });
    nav.addEventListener("click", (e) => {
      const a = e.target.closest("a");
      if (a) nav.classList.remove("open");
    });
  }

  // Contact form message (works with contact.php redirect params)
  const msg = document.getElementById("formMsg");
  const params = new URLSearchParams(window.location.search);
  if (msg && params.has("sent")) {
    msg.textContent = "✅ Message sent! We'll contact you soon.";
  } else if (msg && params.has("error")) {
    msg.textContent = "⚠️ Could not send. Please try again or email hello@thehexer.site";
    msg.style.color = "rgba(253,164,175,.95)";
  }
})();