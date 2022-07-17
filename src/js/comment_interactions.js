const init = function () {
  console.log(" log: DOM Content successfully loaded");
  document
    .getElementById("submit-reset")
    .addEventListener("click", submitReset);
  document
    .getElementById("submit-comment")
    .addEventListener("click", submitComment);
};

const submitComment = function (ev) {
  ev.preventDefault();
  ev.stopPropagation();

  let validCheck = evaluateInput();

  if (validCheck) {
    document.getElementById("form-add-comment").submit();
  } else {
    alert("wrong input");
    //set red * -interactive
  }
};

const submitReset = function (ev) {
  ev.preventDefault();
  document.getElementById("form-add-comment").reset();
};

function evaluateInput() {
  let valid = true;
  let filePath = document.getElementById("image").value;

  if (filePath === "") {
    //no image submitted -- allowed in comments
  } else {
    let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    //need to check more extensively
    if (!allowedExtensions.exec(filePath)) {
      alert("Invalid file type");
      valid = false;
      //max file size=16kb
    }
  }

  let comment = document.getElementById("comment");
  let username = document.getElementById("username");

  if (
    !(
      username.value.length > 0 &&
      username.value.length <= 50 &&
      comment.value.length > 0 &&
      comment.value.length <= 500
    )
  ) {
    valid = false;
  }
  return valid;
}

// document.addEventListener("DOMContentLoaded", init);
window.addEventListener("load", init);
