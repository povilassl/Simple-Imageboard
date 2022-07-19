const init = function () {
  console.log(" log: DOM Content successfully loaded");
  document
    .getElementById("submit-reset")
    .addEventListener("click", submitReset);
  document
    .getElementById("submit-comment")
    .addEventListener("click", submitComment);
  document.getElementById("deletePost").addEventListener("click", deletePost);
};

const deletePost = function (ev) {
  ev.preventDefault();
  ev.stopPropagation();

  //only check pass len - all characters allowed
  const passLen = document.getElementById("password").value.length;
  if (passLen >= 5 && passLen <= 20) {
    document.getElementById("form-delete").submit();
  } else {
    alert("Invalid password");
  }
};

const submitComment = function (ev) {
  ev.preventDefault();
  ev.stopPropagation();

  const validCheck = evaluateInput();

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

function strContainsBadChars(str) {
  const badChars = "~!@#$%^&*()_+,./;:'-=";
  const arr = badChars.split("");

  for (let i = 0; i < arr.length; i++) {
    if (str.includes(arr[i])) {
      alert("Character not allowed: " + arr[i]);
      return true;
    }
  }

  return false;
}

function evaluateInput() {
  const username = document.getElementById("username").value;
  const comment = document.getElementById("comment").value;
  const filePath = document.getElementById("image").value;

  if (
    !(
      username.length >= 5 &&
      username.length <= 20 &&
      !strContainsBadChars(username)
    )
  ) {
    alert("Invalid username");
    return false;
  }

  if (
    !(
      comment.length >= 5 &&
      comment.length <= 500 &&
      !strContainsBadChars(comment)
    )
  ) {
    alert("Invalid Comment");
    return false;
  }

  if (filePath === "") {
    alert("must upload file");
    return false;
  }

  //find all dots (extensions) in the path
  const occurenceOfExtension = filePath.split(".").length - 1;
  const allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
  const extension = filePath.substr(filePath.lastIndexOf("."));

  if (!allowedExtensionsRegx.test(extension) || occurenceOfExtension != 1) {
    alert("invalid file type");
    return false;
  }

  return true;
}

document.addEventListener("DOMContentLoaded", init);

//temporary filler values TODO: Delete
document.getElementById("username").value = "fillerUsername";
document.getElementById("comment").value = "fillerComment";
