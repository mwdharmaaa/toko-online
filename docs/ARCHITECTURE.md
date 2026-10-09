# System Architecture Specification

## Overview
Mono Archive follows Semantic Atomic Architecture with strict Single Responsibility Files (~150-line soft cap per unit).

### Core Layers:
1. **Domain Layer**: Immutable Value Objects (`Money`, `Sku`, `Slug`, `StockQuantity`) and Contracts.
2. **Action Layer**: Single-action invokers under `app/Actions/*` encapsulating domain business logic.
3. **HTTP Layer**: Thin Controllers delegating mutations to Actions and queries to custom Eloquent Query Builders.
4. **Presentation**: Native Blade templates styled exclusively with Pure CSS without third-party frameworks.
