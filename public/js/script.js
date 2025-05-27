 window.onload = function () {
    var images = document.querySelectorAll(".carousel img");
    var current = 0;

    if (images.length > 0) {
      images[current].classList.add("active");

      setInterval(function () {
        images[current].classList.remove("active");
        current = (current + 1) % images.length;
        images[current].classList.add("active");
      }, 4000);
    }
  };


