# BabiEnergies - Visual Entity Relationship Diagram

## Database Schema Visualization

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email UK
        timestamp email_verified_at
        string password
        string phone
        text address
        enum role
        string profile_image
        json preferences
        string remember_token
        timestamps created_at_updated_at
    }
    
    CATEGORIES {
        bigint id PK
        string name
        string slug UK
        text description
        string image
        bigint parent_id FK
        integer sort_order
        boolean is_active
        timestamps created_at_updated_at
    }
    
    PRODUCTS {
        bigint id PK
        bigint category_id FK
        string name
        string slug UK
        text description
        text short_description
        string sku UK
        decimal price
        decimal sale_price
        decimal cost_price
        integer stock_quantity
        integer min_stock_level
        decimal weight
        string dimensions
        json specifications
        json features
        json images
        boolean is_active
        boolean is_featured
        string meta_title
        text meta_description
        timestamps created_at_updated_at
    }
    
    TECHNICIANS {
        bigint id PK
        bigint user_id FK
        string employee_id UK
        string specialization
        string certification_level
        integer experience_years
        decimal hourly_rate
        json availability_schedule
        decimal rating
        enum status
        timestamps created_at_updated_at
    }
    
    ORDERS {
        bigint id PK
        bigint user_id FK
        string order_number UK
        enum status
        enum payment_status
        string payment_method
        decimal subtotal
        decimal tax_amount
        decimal shipping_amount
        decimal discount_amount
        decimal total_amount
        json shipping_address
        json billing_address
        text notes
        timestamps created_at_updated_at
    }
    
    ORDER_ITEMS {
        bigint id PK
        bigint order_id FK
        bigint product_id FK
        integer quantity
        decimal unit_price
        decimal total_price
        timestamps created_at_updated_at
    }
    
    PAYMENTS {
        bigint id PK
        bigint order_id FK
        string payment_method
        string transaction_id UK
        decimal amount
        string currency
        enum status
        json gateway_response
        text notes
        timestamps created_at_updated_at
    }
    
    REVIEWS {
        bigint id PK
        bigint user_id FK
        bigint product_id FK
        bigint order_id FK
        integer rating
        string title
        text comment
        json photos
        boolean is_verified_purchase
        boolean is_approved
        timestamps created_at_updated_at
    }
    
    ENERGY_AUDITS {
        bigint id PK
        bigint user_id FK
        bigint technician_id FK
        string property_type
        text property_address
        integer property_size
        decimal current_energy_usage
        date audit_date
        enum audit_status
        json recommendations
        decimal estimated_savings
        string report_file
        text notes
        timestamps created_at_updated_at
    }
    
    SOLAR_INSTALLATIONS {
        bigint id PK
        bigint user_id FK
        bigint energy_audit_id FK
        bigint technician_id FK
        decimal system_size
        integer panel_count
        decimal estimated_production
        date installation_date
        date completion_date
        enum status
        json project_files
        integer warranty_period
        text notes
        timestamps created_at_updated_at
    }
    
    MAINTENANCE_VISITS {
        bigint id PK
        bigint solar_installation_id FK
        bigint technician_id FK
        date visit_date
        enum visit_type
        enum status
        text notes
        json photos
        json parts_used
        decimal cost
        timestamps created_at_updated_at
    }

    %% Relationships
    USERS ||--o{ ORDERS : "places"
    USERS ||--o{ ENERGY_AUDITS : "requests"
    USERS ||--o{ SOLAR_INSTALLATIONS : "owns"
    USERS ||--o{ REVIEWS : "writes"
    USERS ||--o| TECHNICIANS : "is"
    
    CATEGORIES ||--o{ PRODUCTS : "contains"
    CATEGORIES ||--o{ CATEGORIES : "parent_of"
    
    ORDERS ||--o{ ORDER_ITEMS : "contains"
    ORDERS ||--o{ PAYMENTS : "has"
    ORDERS ||--o{ REVIEWS : "enables"
    
    PRODUCTS ||--o{ ORDER_ITEMS : "included_in"
    PRODUCTS ||--o{ REVIEWS : "reviewed_in"
    
    TECHNICIANS ||--o{ ENERGY_AUDITS : "performs"
    TECHNICIANS ||--o{ SOLAR_INSTALLATIONS : "installs"
    TECHNICIANS ||--o{ MAINTENANCE_VISITS : "performs"
    
    ENERGY_AUDITS ||--o{ SOLAR_INSTALLATIONS : "leads_to"
    
    SOLAR_INSTALLATIONS ||--o{ MAINTENANCE_VISITS : "requires"
```

## Key Relationships Summary

### E-commerce Flow:
1. **Users** place **Orders** containing **Order Items** (Products)
2. **Orders** have **Payments** for transaction processing
3. **Users** can write **Reviews** for **Products** they've purchased
4. **Products** belong to **Categories** (hierarchical structure)

### Energy Services Flow:
1. **Users** request **Energy Audits** performed by **Technicians**
2. **Energy Audits** can lead to **Solar Installations**
3. **Solar Installations** require **Maintenance Visits** by **Technicians**
4. **Technicians** are specialized users who perform energy services

### Cross-Functional Integration:
- **Users** can be both customers (e-commerce) and service recipients (energy services)
- **Technicians** are specialized users who provide energy services
- **Orders** can include both products and services
- **Reviews** can cover both products and services

## Business Logic Flow

### Customer Journey:
1. **Registration** → User creates account
2. **Browsing** → User browses products by category
3. **Shopping** → User adds products to cart and places order
4. **Payment** → User pays for order
5. **Review** → User reviews purchased products
6. **Energy Services** → User books energy audit and solar installation
7. **Maintenance** → User receives ongoing maintenance services

### Admin/Technician Journey:
1. **Management** → Admin manages products, categories, orders
2. **Service Delivery** → Technician performs energy audits and installations
3. **Maintenance** → Technician provides ongoing maintenance services
4. **Reporting** → System generates reports and analytics

This ERD provides a comprehensive foundation for the BabiEnergies platform, supporting both e-commerce and energy services functionality while maintaining data integrity and supporting business growth.
