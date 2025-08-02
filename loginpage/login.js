console.log("Login.js loaded");

// You can add validation later like:
document.querySelector("form").addEventListener("submit", function (e) {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  if (username === "" || password === "") {
    e.preventDefault();
    alert("Both fields are required!");
  }
});
