export function bindImagePreview(inputEl, imgTargetEl) {
  if (!inputEl || !imgTargetEl) return;
  inputEl.addEventListener('change', () => {
    const file = inputEl.files && inputEl.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        imgTargetEl.src = e.target.result;
        imgTargetEl.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });
}
