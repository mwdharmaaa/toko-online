export function bindConfirmationForms(selector = 'form[data-confirm]') {
  document.querySelectorAll(selector).forEach((form) => {
    form.addEventListener('submit', (e) => {
      const msg = form.dataset.confirm || 'Apakah Anda yakin ingin menghapus data ini?';
      if (!window.confirm(msg)) {
        e.preventDefault();
      }
    });
  });
}
