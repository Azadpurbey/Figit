firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    var query = window.location.search.substring(1);
    var vars = query.split("=");
    var id = vars[1];

    if (id) {
      var blog = firebase
        .database()
        .ref("/blogs")
        .child(id);

      blog.once("value", function(r) {
        // once = just this once, no need to actively watch the changes
        var entry = r.val();

        document.getElementById("author").value = entry.author;
        document.getElementById("date").value = entry.date;
        document.getElementById("title").value = entry.title;
        document.getElementById("image").value = entry.image;
        document.getElementById("description").value = entry.description;

        CKEDITOR.replace("description");
      });
    }

    document
      .getElementById("update_entry")
      .addEventListener("submit", function(e) {
        e.preventDefault();

        blog
          .transaction(function(entry) {
            entry = entry || {};
            entry.title = document.getElementById("title").value;
            entry.description = CKEDITOR.instances.description.getData();
            entry.author = document.getElementById("author").value;
            entry.date = document.getElementById("date").value;
            entry.image = document.getElementById("image").value;;

            return entry;
          })
          .then(function() {
            window.location.href = "blog.html?id=" + id;
          })
          .catch(function(error) {
            alert(error);
          });

        return false;
      });
  } else {
    // content not found
    window.location.href = "index.html";
  }
});

// document.getElementById("author").innerText = blog.author;
