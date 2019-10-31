var query = window.location.search.substring(1);
var vars = query.split("=");
var id = vars[1];

var blog = firebase
  .database()
  .ref("/blogs")
  .child(id);

blog.on("value", function(item) {
  var entry = item.val();

  if (entry) {
    document.getElementById("author").innerHTML = entry.author;
    document.getElementById("date").innerHTML = entry.date;
    document.getElementById("title").innerHTML = entry.title;
    document.getElementById("description").innerHTML = entry.description;
    document.getElementById("image").src = entry.image;

    // update button
    document.getElementById("update").href = 'update.html?id=' + id;

    // delete button
    document.getElementById("delete").addEventListener("click", function() {
      if (confirm("This entry will be permanently delete. Are you sure?")) {
        blog.remove();
        window.location.href='index.html';
      }
    });

  } else {
    // content not found
    window.location.href = "index.html";
  }
});

// document.getElementById("author").innerText = blog.author;
