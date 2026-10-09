/**
 * Mono Archive - Admin Panel Vanilla JS Utilities
 * Zero Framework | Pure Native DOM & Events
 */

document.addEventListener('DOMContentLoaded', () => {
  // File Input Preview
  const imageInputs = document.querySelectorAll('input[type="file"][data-preview]');
  imageInputs.forEach(input => {
    const previewTargetId = input.dataset.preview;
    const previewEl = document.getElementById(previewTargetId);

    if (previewEl) {
      input.addEventListener('change', () => {
        const file = input.files && input.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            previewEl.src = e.target.result;
            previewEl.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
    }
  });

  // Delete Confirmation Interceptor
  const deleteForms = document.querySelectorAll('form[data-confirm]');
  deleteForms.forEach(form => {
    form.addEventListener('submit', (e) => {
      const promptText = form.dataset.confirm || 'Apakah Anda yakin ingin menghapus data ini?';
      if (!window.confirm(promptText)) {
        e.preventDefault();
      }
    });
  });

  // Settings Template Live Previewer
  const templateTextarea = document.getElementById('settings-wa-template');
  const previewBox = document.getElementById('settings-wa-preview');
  if (templateTextarea && previewBox) {
    function refreshSettingPreview() {
      const template = templateTextarea.value;
      const sample = template
        .replace(/\{store_name\}/g, 'MONO ARCHIVE')
        .replace(/\{product_name\}/g, 'Heavy Canvas Utility Tote Bag')
        .replace(/\{sku\}/g, 'MN-001')
        .replace(/\{price\}/g, 'Rp 385.000')
        .replace(/\{quantity\}/g, '2')
        .replace(/\{total_price\}/g, 'Rp 770.000')
        .replace(/\{customer_notes\}/g, 'Warna Raw Black')
        .replace(/\{product_url\}/g, window.location.origin + '/products/heavy-canvas-utility-tote-bag');

      previewBox.textContent = sample;
    }

    templateTextarea.addEventListener('input', refreshSettingPreview);
    refreshSettingPreview();
  }
});
