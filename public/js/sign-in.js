function getUiConfig() {
  return {
    callbacks: {
      signInSuccess: function(user, credential, redirectUrl) {
        handleSignedInUser(user);
        return false;
      }
    },
    signInFlow: "popup",
    signInOptions: [
      firebase.auth.GoogleAuthProvider.PROVIDER_ID,
      firebase.auth.EmailAuthProvider.PROVIDER_ID,
      firebase.auth.FacebookAuthProvider.PROVIDER_ID,
      firebase.auth.TwitterAuthProvider.PROVIDER_ID
    ],
    tosUrl: "https://www.google.com"
  };
}

var ui = new firebaseui.auth.AuthUI(firebase.auth());
ui.start("#firebaseui-container", getUiConfig());

var handleSignedInUser = function(user) {
  console.log("HandleSignedInUser");
  document.getElementById("user-signed-in").style.display = "block";
  document.getElementById("user-signed-out").style.display = "none";
};

var handleSignedOutUser = function() {
  console.log("HandleSignedOutUser");
  document.getElementById("user-signed-in").style.display = "none";
  document.getElementById("user-signed-out").style.display = "block";
};

firebase.auth().onAuthStateChanged(function(user) {
  document.getElementById("loading").style.display = "none";
  document.getElementById("loaded").style.display = "block";
  console.log("AuthStateChange");
  if (user) {
    window.location = "account.html";
  }
});

var initApp = function() {
  console.log("initApp");
};

window.addEventListener("load", initApp);
