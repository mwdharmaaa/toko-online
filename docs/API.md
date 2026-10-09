# Storefront REST API v1 Specification

All endpoints return JSON wrapped with standard resource structures.

## Endpoints

- `GET /api/v1/settings`: Public store branding, address, and WhatsApp contact.
- `GET /api/v1/products`: Filterable product catalog with pagination (`q`, `category`).
- `GET /api/v1/products/{slug}`: Single product specifications and stock details.
- `GET /api/v1/categories`: Active category taxonomy list.
- `GET /api/v1/blog`: Editorial journal archive.
- `GET /api/v1/blog/{slug}`: Single article contents and reading time.
