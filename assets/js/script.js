// HAMBURGER NAV
function toggleClick() {
  const toggleSideBar = document.querySelector('.ham-bar');
  const toggleIcon = document.getElementById('toggleIcon');

  if (toggleSideBar.style.display === "block") {
    toggleSideBar.style.display = "none";
    toggleIcon.classList.remove('fa-close');
    toggleIcon.classList.add('fa-bars');
  } else {
    toggleSideBar.style.display = "block";
    toggleIcon.classList.remove('fa-bars');
    toggleIcon.classList.add('fa-close');
  }
}

//SHOW HIDE PASSWORD
function openPass(icon) {
  const inputPass = icon.parentElement.nextElementSibling;
  // const iconEye = document.getElementById('eye');
  if (inputPass.getAttribute('type') === 'password') {
    inputPass.setAttribute('type', 'text');
    icon.classList.replace('fa-eye-slash', 'fa-eye');
  } else {
    inputPass.setAttribute('type', 'password');
    icon.classList.replace('fa-eye', 'fa-eye-slash');
  }
}

// CLOSE NOTIFICATION | ALERT
function closeAlert() {
  const alert = document.querySelector('.success-update')
  if (alert) {
    alert.style.display = "none";
  }
}

// CLOSE SIDEBAR USR
function closeSideBar() {
  const sideBar = document.getElementById('sidebar');
  const sideBarIcon = document.getElementById('sideBarIcon');
  const fas = sideBarIcon.firstElementChild;
  sideBar.classList.toggle('menu-close');

  if (sideBar.className == 'menu-close') {
    sideBarIcon.style.left = '0px';
    fas.classList.remove('fa-chevron-left');
    fas.classList.add('fa-chevron-right');
  } else {
    sideBarIcon.style.left = '300px';
    fas.classList.remove('fa-chevron-right');
    fas.classList.add('fa-chevron-left');
  }
}

// onchange event untuk input jenis akun
function inputPT() {
  const jenis = document.getElementById('jenis_akun').value;
  const perusahaan = document.getElementById('perusahaan');
  perusahaan.style.display = 'none';
  console.log(jenis);

  if (jenis === 'Perusahaan') {
    perusahaan.style.display = 'flex';
    document.getElementById('inputPerusahaan').removeAttribute('disabled');
  } else if (jenis === 'Pribadi') {
    perusahaan.style.display = 'none';
    document.getElementById('inputPerusahaan').setAttribute('disabled', false);
  }
}