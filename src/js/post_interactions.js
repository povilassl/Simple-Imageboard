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

function strContainsBadChars(str) {
  let ans = false;
  let badChars = "~ ! @ # $ % ^ & * ( ) _ + , . / ; : ' - =";
  let arr = badChars.split(" ");
  arr.forEach((el) => {
    if (str.includes(el)) {
      alert(str + " : " + el);
      ans = true;
    }
  });
  return ans;
}

function evaluateInput() {
  let valid = true;
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let title = document.getElementById("title").value;
  let comment = document.getElementById("comment").value;
  let filePath = document.getElementById("image").value;

  let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

  if (
    username.length >= 5 &&
    username.length <= 20 &&
    title.length >= 5 &&
    title.length <= 50 &&
    comment.length >= 5 &&
    comment.length <= 500 &&
    password.length >= 5 &&
    password.length <= 20 &&
    !strContainsBadChars(username) &&
    !strContainsBadChars(title) &&
    !strContainsBadChars(comment) &&
    filePath !== ""
  ) {
  } else {
    valid = false;
  }

  //TODO: more extensive checks
  if (!allowedExtensions.exec(filePath)) {
    alert("Invalid file type");
    valid = false;
    //max file size=16kb -- or sth like that (medium blob)
  }
  return valid;
}

document.addEventListener("DOMContentLoaded", init);
