firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    CKEDITOR.replace("description");
    document
      .getElementById("update_entry")
      .addEventListener("submit", function(e) {
        e.preventDefault();
        var blog = firebase.database().ref("/blogs");
        title = document.getElementById("title").value;
        description = CKEDITOR.instances.description.getData();
        author = document.getElementById("author").value;
        date = document.getElementById("date").value;
        image = document.getElementById("image").value;
        blog.push(
          {
            author: author,
            date: date,
            image: image,
            title: title,
            description: description
          },
          error => {
            if (error) {
              console.log(error);
            } else {
              window.location.href = "blogs.html";
            }
          }
        );
      });
  } else {
    // content not found
  }
});

// document.getElementById("author").innerText = blog.author;
