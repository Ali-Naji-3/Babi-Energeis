import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Layout from './Layout/Layout';
import HomePage from '../pages/HomePage';
import ProductsPage from '../pages/ProductsPage';
import ProductDetailsPage from '../pages/ProductDetailsPage';
import LoginPage from '../pages/LoginPage';
import RegisterPage from '../pages/RegisterPage';
import CustomerDashboard from '../pages/CustomerDashboard';
import CartPage from '../pages/CartPage';
import CheckoutPage from '../pages/CheckoutPage';
import OrdersPage from '../pages/OrdersPage';
import ProfilePage from '../pages/ProfilePage';
import EnergyAuditPage from '../pages/EnergyAuditPage';
import SolarRequestPage from '../pages/SolarRequestPage';
import InstallationTrackingPage from '../pages/InstallationTrackingPage';
import MaintenancePage from '../pages/MaintenancePage';
import { AuthProvider } from '../contexts/AuthContext';
import { CartProvider } from '../contexts/CartContext';

function App() {
    return (
        <AuthProvider>
            <CartProvider>
                <Routes>
                    {/* Public Routes */}
                    <Route path="/" element={<Layout />}>
                        <Route index element={<HomePage />} />
                        <Route path="products" element={<ProductsPage />} />
                        <Route path="products/:id" element={<ProductDetailsPage />} />
                        <Route path="login" element={<LoginPage />} />
                        <Route path="register" element={<RegisterPage />} />
                        
                        {/* Protected Customer Routes */}
                        <Route path="home" element={<CustomerDashboard />} />
                        <Route path="cart" element={<CartPage />} />
                        <Route path="checkout" element={<CheckoutPage />} />
                        <Route path="orders" element={<OrdersPage />} />
                        <Route path="profile" element={<ProfilePage />} />
                        <Route path="energy-audit" element={<EnergyAuditPage />} />
                        <Route path="solar-request" element={<SolarRequestPage />} />
                        <Route path="installations" element={<InstallationTrackingPage />} />
                        <Route path="maintenance" element={<MaintenancePage />} />
                    </Route>
                </Routes>
            </CartProvider>
        </AuthProvider>
    );
}

export default App;
