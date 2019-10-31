var database = firebase.database();

function writeBlogs(author, date, photoURL, title, description) {
  firebase
    .database()
    .ref("blogs/")
    .push({
      author: author,
      date: date,
      image: photoURL,
      title: title,
      description: description
    });
}
// writeBlogs(
//   "Agosh",
//   "04 Aug, 2019",
//   "https://picsum.photos/seed/picsum/600/400",
//   "What we have done in last six weeks?",
//   "John is an Internet entrepreneur with almost 20 years of experience.John is an Internet entrepreneur with almost 20year of experience."
// );
// Reading Blogs
var Blogs = firebase
  .database()
  .ref("/blogs")
  .limitToLast(4);
Blogs.once("value").then(snapshot => {
  var html = "";
  var init = `<div class="blog-links">
  <a href="./about.html">Latest</a>
  <a href="./features.html">Brand Positioning</a>
  <a class="active" href="./blogs.html">Social Media Marketing</a>
  <a href="./contact-us.html">Content Marketing</a>
  <a href="./account.html">Search Engine...</a>
  <hr>
  </div>`;

  snapshot.forEach(blog => {
    // console.log(blog.val());
    var author = blog.val().author;
    var date = blog.val().date;
    var image = blog.val().image;
    var title = blog.val().title;
    var description = blog.val().description;
    html =
      `<div class="row block">
        <a href="blog.html?id=${blog.key} "  style="text-decoration:none!important; color:black!important;">
          <div class="col-md-12">
            <div class="card">
              <div class="thumbnail card">
                <div class="head">
                  <div class="logo">
                    <img style="width: 100%;" src="./image/blogs/new logo2.png">
                  </div>
                  <div>
                    <h5>${author}</h5>
                    <p>${date}</p>
                  </div>
                </div>
                <img class="card-img-top" src=${image}>
                <div class="card-body">
                  <h4 class="card-title">${title}</h4>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>` + html;
  });
  document.getElementById("item1").innerHTML = init + html;
});

var AllBlogs = firebase.database().ref("/blogs");
AllBlogs.once("value").then(snapshot => {
  var html = "";
  var init = `<h6>Trending Post</h6>`;

  snapshot.forEach(blog => {
    // console.log(blog.val());
    var image = blog.val().image;
    var title = blog.val().title;
    html =
      `<a href="blog.html?id=${blog.key}"><div row>
    <div class="col-md-3 ">
      <img class="img-circle oval" src=${image}/>
    </div>
    <br>
    <div class="col-md-9">
      <div class="text" >
        <p>${title}</p>
        </div>
      </div>
    </div>
    </a>
    <br>
    <br>
    <hr>` + html;
  });
  document.getElementById("item2").innerHTML = init+html;
});
