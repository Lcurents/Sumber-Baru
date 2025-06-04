document.addEventListener('DOMContentLoaded', function () {
  var hamburgerBtn = document.querySelector('.hamburger-btn');
  var sideBar = document.querySelector('.side-bar');
  if (hamburgerBtn && sideBar) {
    hamburgerBtn.addEventListener('click', sidebarToggle);
  }

  function sidebarToggle() {
    sideBar.classList.toggle('active');
  }

  var modeSwitcher = document.querySelector('.mode-switch i');
  var body = document.querySelector('body');
  if (modeSwitcher) {
    modeSwitcher.addEventListener('click', modeSwitch);
  }

  function modeSwitch() {
    body.classList.toggle('active');
  }
});
document.querySelector('.mode-switch').addEventListener('click', () => {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  fetch('/theme/toggle', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': token,
      Accept: 'application/json',
    },
  }).then(() => location.reload());
});
