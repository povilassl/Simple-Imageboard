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
});

function uploadPostToDB(username, title, comment) {
  var query_str =
    "INSERT INTO my_db.posts(id, username, title, comment) VALUES (DEFAULT, '" +
    username +
    "', '" +
    title +
    "', '" +
    comment +
    "')";

  connection.query(query_str, function (err, result) {
    if (err) throw err;
    console.log("1 record inserted");
  });
}

uploadPostToDB("name1", "title1", "aaksjdhaksjdhkajshdjashs");
