// Script for scrollspy,, and theme toggle
(function(){
  const yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();


  // Theme toggle
  const root = document.documentElement;
  const stored = localStorage.getItem('ascapstone-theme');
  if (stored) root.setAttribute('data-bs-theme', stored);

  function toggleTheme(){
    const current = root.getAttribute('data-bs-theme') || 'light';
    const next = current === 'light' ? 'dark' : 'light';
    root.setAttribute('data-bs-theme', next);
    localStorage.setItem('ascapstone-theme', next);
  }

  const themeToggle = document.getElementById('themeToggle');
  const themeToggleFooter = document.getElementById('themeToggleFooter');
  if (themeToggle) themeToggle.addEventListener('click', toggleTheme);
  if (themeToggleFooter) themeToggleFooter.addEventListener('click', toggleTheme);
})();
