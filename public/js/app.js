/**
 * Mono Archive - Vanilla JS Storefront Utilities
 * Zero Framework | Pure Native DOM & Events
 */

document.addEventListener('DOMContentLoaded', () => {
  // Toast Helper
  window.showToast = function (message, duration = 3000) {
    let toast = document.getElementById('global-toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'global-toast';
      toast.className = 'toast';
      document.body.appendChild(toast);
    }
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(window.__toastTimeout);
    window.__toastTimeout = setTimeout(() => {
      toast.classList.remove('show');
    }, duration);
  };

  // Mobile Menu Toggle
  const mobileToggle = document.getElementById('mobile-nav-toggle');
  const mobileMenu = document.getElementById('mobile-nav-menu');
  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('active');
    });
  }

  // Product Detail - WhatsApp Interactive Builder
  const waContainer = document.getElementById('wa-order-builder');
  if (waContainer) {
    const rawTemplate = waContainer.dataset.template || '';
    const phone = waContainer.dataset.phone || '';
    const productName = waContainer.dataset.productName || '';
    const productSku = waContainer.dataset.productSku || '';
    const unitPrice = parseFloat(waContainer.dataset.price || '0');
    const productUrl = waContainer.dataset.productUrl || window.location.href;
    const storeName = waContainer.dataset.storeName || 'MONO ARCHIVE';
    const maxStock = parseInt(waContainer.dataset.stock || '999', 10);

    const qtyInput = document.getElementById('wa-qty-input');
    const btnMinus = document.getElementById('wa-qty-minus');
    const btnPlus = document.getElementById('wa-qty-plus');
    const notesInput = document.getElementById('wa-notes-input');
    const previewBox = document.getElementById('wa-message-preview');
    const waButton = document.getElementById('wa-submit-button');
    const copyButton = document.getElementById('wa-copy-button');

    function formatRupiah(amount) {
      return 'Rp ' + Math.round(amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function updateWhatsAppOrder() {
      let qty = parseInt(qtyInput ? qtyInput.value : '1', 10);
      if (isNaN(qty) || qty < 1) qty = 1;
      if (maxStock > 0 && qty > maxStock) qty = maxStock;
      if (qtyInput) qtyInput.value = qty;

      const notes = (notesInput && notesInput.value.trim()) ? notesInput.value.trim() : '-';
      const totalPrice = formatRupiah(unitPrice * qty);
      const unitPriceFormatted = formatRupiah(unitPrice);

      let compiledMessage = rawTemplate
        .replace(/\{store_name\}/g, storeName)
        .replace(/\{product_name\}/g, productName)
        .replace(/\{sku\}/g, productSku)
        .replace(/\{price\}/g, unitPriceFormatted)
        .replace(/\{quantity\}/g, qty.toString())
        .replace(/\{total_price\}/g, totalPrice)
        .replace(/\{customer_notes\}/g, notes)
        .replace(/\{product_url\}/g, productUrl);

      if (previewBox) {
        previewBox.textContent = compiledMessage;
      }

      if (waButton) {
        const cleanPhone = phone.replace(/[^0-9]/g, '');
        const finalUrl = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(compiledMessage)}`;
        waButton.href = finalUrl;
      }

      return compiledMessage;
    }

    if (btnMinus && qtyInput) {
      btnMinus.addEventListener('click', () => {
        let val = parseInt(qtyInput.value, 10) || 1;
        if (val > 1) {
          qtyInput.value = val - 1;
          updateWhatsAppOrder();
        }
      });
    }

    if (btnPlus && qtyInput) {
      btnPlus.addEventListener('click', () => {
        let val = parseInt(qtyInput.value, 10) || 1;
        if (maxStock <= 0 || val < maxStock) {
          qtyInput.value = val + 1;
          updateWhatsAppOrder();
        }
      });
    }

    if (qtyInput) {
      qtyInput.addEventListener('input', updateWhatsAppOrder);
    }

    if (notesInput) {
      notesInput.addEventListener('input', updateWhatsAppOrder);
    }

    if (copyButton) {
      copyButton.addEventListener('click', () => {
        const textToCopy = updateWhatsAppOrder();
        navigator.clipboard.writeText(textToCopy).then(() => {
          window.showToast('Format pesan WhatsApp berhasil disalin.');
        }).catch(() => {
          window.showToast('Gagal menyalin teks ke clipboard.');
        });
      });
    }

    // Initial compile
    updateWhatsAppOrder();
  }
});
