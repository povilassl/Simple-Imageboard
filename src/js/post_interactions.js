const init = function () {
  console.log(" log: DOM Content successfully loaded");
  document
    .getElementById("submit-reset")
    .addEventListener("click", submitReset);
  document.getElementById("submit-post").addEventListener("click", submitPost);
};

const submitPost = function (ev) {
  ev.preventDefault();
  ev.stopPropagation();

  let validCheck = evaluateInput();

  if (validCheck) {
    document.getElementById("form-add-post").submit();
  } else {
    alert("wrong input");
    //set red * -interactive
  }
};

const submitReset = function (ev) {
  ev.preventDefault();
  document.getElementById("form-add-post").reset();
};

function evaluateInput() {
  let valid = true;
  let username = document.getElementById("username");
  let password = document.getElementById("password");
  let title = document.getElementById("title");
  let comment = document.getElementById("comment");
  let image = document.getElementById("image");
  let filePath = image.value;

  let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

  if (
    !(
      username.value.length > 0 &&
      username.value.length <= 50 &&
      comment.value.length > 0 &&
      comment.value.length <= 500 &&
      title.value.length > 0 &&
      title.value.length <= 100 &&
      password.value.length > 0 &&
      password.value.length <= 20 &&
      filePath !== ""
    )
  ) {
    valid = false;
  }
  if (!allowedExtensions.exec(filePath)) {
    //alert("Invalid file type");
    valid = false;
    //max file size=16kb -- or sth like that (medium blob)
  }
  return valid;
}

document.addEventListener("DOMContentLoaded", init);
