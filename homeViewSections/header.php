<div class="header-img">

    <img src="images/LogoTemp.png" alt="logo" class="logo-img">
</div>

<div>
    <button type="button" class="phone-num-btn">
        <p>Call Now!</p>
        <p><a href="tel:508-717-1249">508-717-1249</a></p>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const logo = document.querySelector('.logo-img');
  window.addEventListener('scroll', function() {
    if (window.scrollY > 0) {
      logo.classList.add('hide-on-scroll');
    } else {
      logo.classList.remove('hide-on-scroll');
    }
  });
});
</script>


