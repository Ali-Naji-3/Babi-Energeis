# BabiEnergies - Entity Relationship Diagram (ERD) Documentation

## Project Overview
BabiEnergies is a sustainable energy solutions platform specializing in solar, energy efficiency, and green technology. The platform combines e-commerce functionality with energy services.

## Database Schema Overview

### Core Entities

#### 1. USERS Table
- **Primary Key**: id
- **Fields**:
  - name (string)
  - email (string, unique)
  - email_verified_at (timestamp, nullable)
  - password (string)
  - phone (string, nullable)
  - address (text, nullable)
  - role (enum: 'customer', 'admin')
  - profile_image (string, nullable)
  - preferences (json, nullable)
  - remember_token
  - timestamps

#### 2. CATEGORIES Table
- **Primary Key**: id
- **Fields**:
  - name (string)
  - slug (string, unique)
  - description (text, nullable)
  - image (string, nullable)
  - parent_id (foreign key to categories, nullable) - Self-referencing for hierarchical categories
  - sort_order (integer, default: 0)
  - is_active (boolean, default: true)
  - timestamps

#### 3. PRODUCTS Table
- **Primary Key**: id
- **Foreign Keys**:
  - category_id (references categories.id)
- **Fields**:
  - name (string)
  - slug (string, unique)
  - description (text)
  - short_description (text, nullable)
  - sku (string, unique)
  - price (decimal 10,2)
  - sale_price (decimal 10,2, nullable)
  - cost_price (decimal 10,2, nullable)
  - stock_quantity (integer, default: 0)
  - min_stock_level (integer, default: 5)
  - weight (decimal 8,2, nullable)
  - dimensions (string, nullable)
  - specifications (json, nullable)
  - features (json, nullable)
  - images (json, nullable)
  - is_active (boolean, default: true)
  - is_featured (boolean, default: false)
  - meta_title (string, nullable)
  - meta_description (text, nullable)
  - timestamps

#### 4. TECHNICIANS Table
- **Primary Key**: id
- **Foreign Keys**:
  - user_id (references users.id)
- **Fields**:
  - employee_id (string, unique)
  - specialization (string)
  - certification_level (string)
  - experience_years (integer)
  - hourly_rate (decimal 8,2)
  - availability_schedule (json, nullable)
  - rating (decimal 3,2, default: 0)
  - status (enum: 'available', 'busy', 'offline', default: 'available')
  - timestamps

### E-commerce Entities

#### 5. ORDERS Table
- **Primary Key**: id
- **Foreign Keys**:
  - user_id (references users.id)
- **Fields**:
  - order_number (string, unique)
  - status (enum: 'pending', 'processing', 'shipped', 'delivered', 'cancelled')
  - payment_status (enum: 'pending', 'paid', 'failed', 'refunded')
  - payment_method (string, nullable)
  - subtotal (decimal 10,2)
  - tax_amount (decimal 10,2, default: 0)
  - shipping_amount (decimal 10,2, default: 0)
  - discount_amount (decimal 10,2, default: 0)
  - total_amount (decimal 10,2)
  - shipping_address (json)
  - billing_address (json)
  - notes (text, nullable)
  - timestamps

#### 6. ORDER_ITEMS Table
- **Primary Key**: id
- **Foreign Keys**:
  - order_id (references orders.id)
  - product_id (references products.id)
- **Fields**:
  - quantity (integer)
  - unit_price (decimal 10,2)
  - total_price (decimal 10,2)
  - timestamps

#### 7. PAYMENTS Table
- **Primary Key**: id
- **Foreign Keys**:
  - order_id (references orders.id)
- **Fields**:
  - payment_method (string)
  - transaction_id (string, unique)
  - amount (decimal 10,2)
  - currency (string, 3 chars, default: 'USD')
  - status (enum: 'pending', 'completed', 'failed', 'refunded')
  - gateway_response (json, nullable)
  - notes (text, nullable)
  - timestamps

#### 8. REVIEWS Table
- **Primary Key**: id
- **Foreign Keys**:
  - user_id (references users.id)
  - product_id (references products.id)
  - order_id (references orders.id, nullable)
- **Fields**:
  - rating (integer, 1-5)
  - title (string)
  - comment (text)
  - photos (json, nullable)
  - is_verified_purchase (boolean, default: false)
  - is_approved (boolean, default: false)
  - timestamps

### Energy Services Entities

#### 9. ENERGY_AUDITS Table
- **Primary Key**: id
- **Foreign Keys**:
  - user_id (references users.id)
  - technician_id (references technicians.id, nullable)
- **Fields**:
  - property_type (string)
  - property_address (text)
  - property_size (integer)
  - current_energy_usage (decimal 10,2)
  - audit_date (date)
  - audit_status (enum: 'scheduled', 'in_progress', 'completed', 'cancelled')
  - recommendations (json, nullable)
  - estimated_savings (decimal 10,2, nullable)
  - report_file (string, nullable)
  - notes (text, nullable)
  - timestamps

#### 10. SOLAR_INSTALLATIONS Table
- **Primary Key**: id
- **Foreign Keys**:
  - user_id (references users.id)
  - energy_audit_id (references energy_audits.id, nullable)
  - technician_id (references technicians.id, nullable)
- **Fields**:
  - system_size (decimal 8,2)
  - panel_count (integer)
  - estimated_production (decimal 10,2)
  - installation_date (date)
  - completion_date (date, nullable)
  - status (enum: 'quoted', 'approved', 'in_progress', 'completed', 'maintenance')
  - project_files (json, nullable)
  - warranty_period (integer, default: 25 years)
  - notes (text, nullable)
  - timestamps

#### 11. MAINTENANCE_VISITS Table
- **Primary Key**: id
- **Foreign Keys**:
  - solar_installation_id (references solar_installations.id)
  - technician_id (references technicians.id)
- **Fields**:
  - visit_date (date)
  - visit_type (enum: 'routine', 'repair', 'inspection')
  - status (enum: 'scheduled', 'in_progress', 'completed', 'cancelled')
  - notes (text, nullable)
  - photos (json, nullable)
  - parts_used (json, nullable)
  - cost (decimal 10,2, default: 0)
  - timestamps

## Entity Relationships

### One-to-Many Relationships:
1. **Users → Orders**: One user can have many orders
2. **Users → Energy Audits**: One user can have many energy audits
3. **Users → Solar Installations**: One user can have many solar installations
4. **Users → Reviews**: One user can write many reviews
5. **Categories → Products**: One category can have many products
6. **Orders → Order Items**: One order can have many order items
7. **Orders → Payments**: One order can have many payments
8. **Products → Order Items**: One product can be in many order items
9. **Products → Reviews**: One product can have many reviews
10. **Technicians → Energy Audits**: One technician can perform many energy audits
11. **Technicians → Solar Installations**: One technician can work on many solar installations
12. **Technicians → Maintenance Visits**: One technician can perform many maintenance visits
13. **Solar Installations → Maintenance Visits**: One solar installation can have many maintenance visits
14. **Energy Audits → Solar Installations**: One energy audit can lead to many solar installations

### Many-to-Many Relationships:
1. **Users ↔ Products** (through Reviews): Users can review multiple products, products can be reviewed by multiple users

### Self-Referencing Relationships:
1. **Categories → Categories**: Categories can have parent categories (hierarchical structure)

## Business Rules

### E-commerce Rules:
1. Orders must have at least one order item
2. Order items must reference valid products
3. Payments must be associated with valid orders
4. Reviews can only be written by users who have purchased the product (verified purchase)
5. Stock quantity cannot go below zero
6. Sale price must be less than or equal to regular price

### Energy Services Rules:
1. Energy audits must be scheduled before solar installations
2. Solar installations must have a valid technician assigned
3. Maintenance visits must be associated with existing solar installations
4. Technicians must have valid certifications for their specialization
5. Energy audits can only be performed by certified technicians

### User Management Rules:
1. Users can have either 'customer' or 'admin' role
2. Technicians must be associated with a user account
3. Only customers can place orders and book energy services
4. Admins can manage all aspects of the system

## Indexes and Performance Optimization

### Primary Indexes:
- All primary keys are automatically indexed
- Foreign keys are indexed for join performance

### Custom Indexes:
- Users: role index for role-based queries
- Categories: is_active, sort_order for filtering and ordering
- Products: is_active, is_featured for product visibility
- Products: category_id, is_active for category-based product queries
- Orders: user_id, status for user order history
- Orders: order_number for order lookup
- Energy Audits: user_id, audit_status for user audit history
- Energy Audits: technician_id, audit_date for technician scheduling
- Solar Installations: user_id, status for user installation history
- Solar Installations: technician_id, installation_date for technician scheduling
- Maintenance Visits: solar_installation_id, visit_date for installation maintenance history
- Maintenance Visits: technician_id, status for technician scheduling
- Payments: order_id, status for payment tracking
- Payments: transaction_id for payment lookup
- Reviews: product_id, is_approved for product review display
- Reviews: user_id for user review history
- Reviews: rating for rating-based queries

## Data Integrity Constraints

### Foreign Key Constraints:
- All foreign keys have proper CASCADE or SET NULL constraints
- User deletion cascades to orders, energy audits, solar installations, and reviews
- Category deletion cascades to products
- Order deletion cascades to order items and payments
- Product deletion cascades to order items and reviews
- Solar installation deletion cascades to maintenance visits

### Check Constraints:
- Rating values must be between 1 and 5
- Stock quantity cannot be negative
- Prices must be positive
- Email addresses must be unique
- Order numbers must be unique
- SKU must be unique
- Employee ID must be unique

## Security Considerations

1. **Password Security**: Passwords are hashed using Laravel's built-in hashing
2. **Email Verification**: Email verification tokens for account security
3. **Session Management**: Secure session handling with IP and user agent tracking
4. **Data Validation**: All input data is validated before database insertion
5. **Role-Based Access**: Different access levels for customers and admins
6. **Audit Trail**: Timestamps on all entities for tracking changes

## Scalability Considerations

1. **Pagination**: All list queries should implement pagination
2. **Caching**: Frequently accessed data should be cached
3. **Database Optimization**: Regular index maintenance and query optimization
4. **File Storage**: Large files (reports, images) should be stored in cloud storage
5. **API Design**: RESTful API endpoints for mobile and third-party integrations

## Future Enhancements

### Potential Additional Entities:
1. **Coupons**: Discount codes and promotional offers
2. **Wishlists**: User wishlist functionality
3. **Notifications**: System notifications for users
4. **Appointments**: Scheduling system for energy services
5. **Invoices**: Detailed billing and invoicing system
6. **Warranties**: Warranty tracking and management
7. **Equipment**: Solar equipment and component tracking
8. **Certifications**: Technician certification management
9. **Reports**: Analytics and reporting system
10. **Integrations**: Third-party service integrations

This ERD provides a solid foundation for the BabiEnergies platform, supporting both e-commerce functionality and energy services while maintaining data integrity and performance optimization.
