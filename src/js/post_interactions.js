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

//move to for loop for faster return
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
document.getElementById("username").value = "fillerValue";
document.getElementById("title").value = "fillerValue";
document.getElementById("comment").value = "fillerValue";
