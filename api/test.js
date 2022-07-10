//initialize app
const express = require("express");
const app = express();
app.listen(3000, () => console.log("listening at 3000"));
app.use(express.static("../public"));

//init db
const mysql = require("mysql");
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "my_db",
});
connection.connect((err) => {
  if (err) throw err;
  console.log("Connected!");
  // connection.query(
  //   "select * from my_db.posts",
  //   function (err, result, fields) {
  //     if (err) throw err;
  //     console.log(result);
  //   }
  // );
});

function uploadPostToDB(username, title, comment) {
  query_str =
    "INSERT INTO `posts`(`id`, `username`, `title`, `comment`) VALUES (DEFAULT, " +
    username +
    ", " +
    title +
    ", " +
    comment +
    ")";
  //   con.query(query_str, function (err, result, fields) {
  //     if (err) throw err;
  //     console.log(result);
  //   });
  var sql =
    "INSERT INTO posts (id, username, title, comment) VALUES (DEFAULT, 'Ajeet Kumar', 'asdkjhtitle', 'Allahabadaskdhaksjdhkjashdj')";
  connection.query(sql, function (err, result) {
    if (err) throw err;
    console.log("1 record inserted");
  });
}

uploadPostToDB("name1", "title1", "aaksjdhaksjdhkajshdjashs");
