const initFileInteractions = function () {
  images = document.images;
  for (let i = 0; i < images.length; i++) {
    if (images[i].id !== "header-image") {
      images[i].addEventListener("click", function () {
        images[i].style.width =
          images[i].style.width === "initial" ? "15%" : "initial";
      });
    }
  }
};

document.addEventListener("DOMContentLoaded", initFileInteractions);
