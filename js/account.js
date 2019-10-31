var ele = `<div class="col-md-4 col-xs-6">
<div class="special-container">
  <h4 id="coursename">Segmentation and target</h4>
  <p id="type">
    Brand Positioning
  </p>
  <p>Completed on- <span id="date"></span></p>
</div>
</div>`;

var database = firebase.database();
function writeUserData(userId, name, email, photoURL) {
  firebase
    .database()
    .ref("users/" + userId)
    .set({
      contactnumber: "",
      emailid: email,
      image: photoURL,
      name: name,
      uid: userId
    });
}

firebase.auth().onAuthStateChanged(function(user) {
  // console.log("AuthStateChange");
  if (user) {
    document.getElementById("main-container").style.display = "block";
    document.getElementById("site-map").style.display = "block";
    var userId = firebase.auth().currentUser.uid;
    // Getting User Details
    firebase
      .database()
      .ref("/users/" + userId)
      .once("value")
      .then(function(snapshot) {
        // console.log(snapshot.val());
        // console.log(userId);
        var name = snapshot.val().name;
        var emailid = snapshot.val().emailid;
        document.getElementById("name").innerText = name;
        document.getElementById("emailid").innerText = emailid;
      });

    // // Updating courses
    // var coursename = "Segmentation and Target";
    // var type = "Brand Positioning";
    // var date = "16 August 2019";
    // firebase
    //   .database()
    //   .ref("users/" + userId + "/Courses")
    //   .push({
    //     coursename: coursename,
    //     type: type,
    //     date: date
    //   });

    // Reading Courses
    var Courses = firebase.database().ref("users/" + userId + "/Courses");
    Courses.once("value").then(snapshot => {
      var html = "";

      snapshot.forEach(course => {
        // console.log(course.val());
        var coursename = course.val().coursename;
        var type = course.val().type;
        var date = course.val().date;
        html =
          `<div class="col-md-4 col-xs-6" style="margin-top: 30px">
            <div class="special-container">
              <h4 id="coursename">${coursename}</h4>
              <p id="type">
                ${type}
              </p>
              <p>Completed on- <span id="date">${date}</span></p>
            </div>
            </div>` + html;
      });
      document.querySelector(
        "body > div.main-container > div.sections.section1 > div > div"
      ).innerHTML = html;
    });

    // Reading Checkpoints
    var checkpoints = firebase
      .database()
      .ref("users/" + userId + "/checkpoints");
    checkpoints.once("value").then(snapshot => {
      var html = "";

      snapshot.forEach(checkpoint => {
        var checkpointname = checkpoint.val();
        html =
          `<div class="col-md-2 col-xs-3">
          <div class="card">
            <div class="thumbnail card">
              <img class="card-img-top" src="./image/account/check1.png">
            </div>
            <div class="card-body">
              <h4 class="card-text"> ${checkpoint.val()}</h4>
            </div>
          </div>
        </div>` + html;
      });
      document.getElementById("checkpoints").innerHTML = html;
    });
  } else {
    window.location = "sign-in.html";
  }
});

var initApp = function() {
  // console.log("initApp");
  document.getElementById("sign-out").addEventListener("click", function() {
    firebase.auth().signOut();
  });
};

window.addEventListener("load", initApp);
