const init = function () {
  console.log(" log: DOM Content successfully loaded");
  document.getElementById("submit-post").addEventListener("click", submitPost);
  document
    .getElementById("submit-reset")
    .addEventListener("click", submitReset);
};

const submitPost = function (ev) {
  ev.preventDefault();
  ev.stopPropagation();

  let validCheck = evaluateInput;

  if (validCheck) {
    document.getElementById("form-add-post").submit();
    document.getElementById("form-add-comment").submit();
  } else {
    alert("wrong input");
    //set red * -interactive
  }
};

const submitReset = function (ev) {
  ev.preventDefault();
  document.getElementById("form-add-post").reset();
  document.getElementById("form-add-comment").reset();
};

const evaluateInput = function (ev) {
  let valid = true;
  let username = document.getElementById("username");
  let title = document.getElementById("title");
  let comment = document.getElementById("comment");
  let image = document.getElementById("image");
  let filePath = image.value;

  let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

  if (
    !(
      username.value.length > 0 &&
      username.value.length <= 50 &&
      title.value.length > 0 &&
      title.value.length <= 100 &&
      comment.value.length > 0 &&
      comment.value.length <= 500 &&
      filePath !== ""
    )
  ) {
    valid = false;
  }
  if (!allowedExtensions.exec(filePath)) {
    alert("Invalid file type");
    fileInput.value = "";
    valid = false;
    //max file size=16kb
  }
  return valid;
};

document.addEventListener("DOMContentLoaded", init);
