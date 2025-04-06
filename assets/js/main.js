// HAMBURGER NAV
function toggleClick() {
    const toggleSideBar = document.querySelector('.ham-bar')
    if (toggleSideBar.style.display === "block") {
        toggleSideBar.style.display = "none";
      } else {
        toggleSideBar.style.display = "block";
      }
}

//SHOW HIDE PASSWORD
function openPass() {
  const inputPass = document.getElementById('pass_user');
  const iconEye = document.getElementById('eye');
  if (inputPass.getAttribute('type') === 'password') {
      inputPass.setAttribute('type', 'text');
      iconEye.classList.replace('fa-eye-slash', 'fa-eye');
  } else {
      inputPass.setAttribute('type', 'password');
      iconEye.classList.replace('fa-eye', 'fa-eye-slash');
  }
}

// CLOSE NOTIFICATION | ALERT
function closeAlert() {
  const alert = document.querySelector('.success-update')
  if (alert) {
    alert.style.display = "none";
  }
}