# WhatsApp Ordering Protocol & Placeholder Reference

The checkout pipeline communicates orders directly to the administrator WhatsApp inbox.

## Supported Placeholders:
- `{store_name}`: Configured brand name
- `{product_name}`: Item title
- `{sku}`: Inventory SKU code
- `{price}`: Formatted unit price in IDR
- `{quantity}`: Selected item count
- `{total_price}`: Calculated subtotal (Unit Price * Quantity)
- `{customer_notes}`: Special buyer specifications or custom sizing
- `{product_url}`: Canonical web link to product detail page
