export function compileWhatsAppMessage(template, params) {
  let msg = template;
  for (const [key, value] of Object.entries(params)) {
    const placeholder = new RegExp(`\\{${key}\\}`, 'g');
    msg = msg.replace(placeholder, value);
  }
  return msg;
}

export function formatWhatsAppUrl(phoneNumber, message) {
  const clean = phoneNumber.replace(/[^0-9]/g, '');
  return `https://wa.me/${clean}?text=${encodeURIComponent(message)}`;
}
