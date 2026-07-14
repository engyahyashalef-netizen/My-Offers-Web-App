document.addEventListener('DOMContentLoaded', () => {

  const navLinks = document.querySelectorAll('.nav a');
  const currentPath = window.location.pathname.split('/').pop();
  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    const baseHref = href.split('?')[0];
    if (
      href === currentPath ||
      (href !== 'index.php' && currentPath.startsWith(baseHref))
    ) {
      link.classList.add('active');
    }
  });


  const registerForm = document.querySelector('form[action="register.php"]');
  if (registerForm) {
    registerForm.addEventListener('submit', function(e) {
      const emailInput = this.querySelector('input[name="email"]');
      const email = emailInput ? emailInput.value.trim() : '';
      // شرط أبسط وأكثر صرامة قليلًا:
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        alert('يرجى إدخال عنوان بريد إلكتروني صالح.');
        e.preventDefault();
      }
    });
  }


  document.querySelectorAll('.deal-card').forEach(card => {
    const qty = parseInt(card.dataset.quantity || '0', 10);
    if (qty <= 0) {
      card.classList.add('sold-out');
      const link = card.querySelector('a');
      if (link) link.removeAttribute('href');
    }
  });

 
  const minusBtn = document.getElementById('qty-minus');
  const plusBtn  = document.getElementById('qty-plus');
  const qtyInput = document.getElementById('qty-input');
  if (minusBtn && plusBtn && qtyInput) {
    minusBtn.addEventListener('click', () => {
      let v = parseInt(qtyInput.value, 10) || 1;
      if (v > 1) qtyInput.value = v - 1;
    });
    plusBtn.addEventListener('click', () => {
      let v = parseInt(qtyInput.value, 10) || 1;
      const max = parseInt(qtyInput.max, 10) || Infinity;
      if (v < max) qtyInput.value = v + 1;
    });
  }
});
