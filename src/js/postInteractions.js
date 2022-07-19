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

  const validCheck = evaluateInput();

  if (validCheck) {
    document.getElementById("form-add-post").submit();
  } else {
    //TODO: set red * -interactive
  }
};

const submitReset = function (ev) {
  ev.preventDefault();
  document.getElementById("form-add-post").reset();
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

//TODO: make this function prettier - more efficient
//maybe sth like - function check(string, min, max, name)
//string - value passed, min and max - interval, name - for alert
//or this - https://stackoverflow.com/questions/4602141/variable-name-as-a-string-in-javascript
function evaluateInput() {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const title = document.getElementById("title").value;
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
    !(title.length >= 5 && title.length <= 50 && !strContainsBadChars(title))
  ) {
    alert("Invalid title");
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

  if (!(password.length >= 5 && password.length <= 20)) {
    alert("Invalid password");
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
document.getElementById("title").value = "fillerTitle";
document.getElementById("comment").value = "fillerComment";
