
-- Sample data for USERS table
INSERT INTO USERS (user_type, fullname, Date_of_Birth, phone_number, email, username, password, location) VALUES
('customer', 'John Doe', '1995-06-15', '09123456789', 'john@example.com', 'johndoe', '$2y$10$examplehash', 'Lagos'),
('admin', 'Admin User', '1985-01-01', '09000000000', 'admin@example.com', 'adminuser', '$2y$10$examplehash', 'Abuja');

-- Sample data for LOGS table
INSERT INTO LOGS (user_id, fullname, username, usertype, email) VALUES
('user-uuid-john', 'John Doe', 'johndoe', 'customer', 'john@example.com'),
('admin-uuid-1234', 'Admin User', 'adminuser', 'admin', 'admin@example.com');

-- Sample data for PRODUCT table
INSERT INTO PRODUCT (product_name, product_company, product_price, product_stock, product_category, added_by_admin_name, added_by_admin_id) VALUES
('Tomato Seeds', 'AgroCo', '450', '100', 'Seeds', 'Admin User', 'admin-uuid-1234'),
('Urea Fertilizer', 'FarmCorp', '1200', '50', 'Fertilizer', 'Admin User', 'admin-uuid-1234');

-- Sample data for CART table
INSERT INTO CART (user_id, fullname, email, product_id, product_name, product_price, order_quantity) VALUES
('user-uuid-john', 'John Doe', 'john@example.com', 'product-uuid-tomato', 'Tomato Seeds', '450', 2),
('user-uuid-john', 'John Doe', 'john@example.com', 'product-uuid-urea', 'Urea Fertilizer', '1200', 1);
