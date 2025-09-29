import React, { useContext } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { AuthContext } from '../../contexts/AuthContext';
import { CartContext } from '../../contexts/CartContext';

function Header() {
    const { user, logout } = useContext(AuthContext);
    const { cartItems } = useContext(CartContext);
    const navigate = useNavigate();

    const handleLogout = () => {
        logout();
        navigate('/');
    };

    const cartItemsCount = cartItems.reduce((total, item) => total + item.quantity, 0);

    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
            <div className="container">
                <Link className="navbar-brand fw-bold" to="/">
                    <i className="bi bi-sun"></i> BabiEnergies
                </Link>
                
                <button 
                    className="navbar-toggler" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav"
                >
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav me-auto">
                        <li className="nav-item">
                            <Link className="nav-link" to="/">Home</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/products">Products</Link>
                        </li>
                        <li className="nav-item dropdown">
                            <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Services
                            </a>
                            <ul className="dropdown-menu">
                                <li><Link className="dropdown-item" to="/energy-audit">Energy Audit</Link></li>
                                <li><Link className="dropdown-item" to="/solar-request">Solar Installation</Link></li>
                                <li><Link className="dropdown-item" to="/maintenance">Maintenance</Link></li>
                            </ul>
                        </li>
                    </ul>

                    <ul className="navbar-nav">
                        {user ? (
                            <>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/cart">
                                        <i className="bi bi-cart3"></i>
                                        Cart ({cartItemsCount})
                                    </Link>
                                </li>
                                <li className="nav-item dropdown">
                                    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i className="bi bi-person-circle"></i> {user.name}
                                    </a>
                                    <ul className="dropdown-menu">
                                        <li><Link className="dropdown-item" to="/home">Dashboard</Link></li>
                                        <li><Link className="dropdown-item" to="/orders">Orders</Link></li>
                                        <li><Link className="dropdown-item" to="/profile">Profile</Link></li>
                                        <li><hr className="dropdown-divider" /></li>
                                        <li>
                                            <button className="dropdown-item" onClick={handleLogout}>
                                                Logout
                                            </button>
                                        </li>
                                    </ul>
                                </li>
                            </>
                        ) : (
                            <>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/login">Login</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/register">Register</Link>
                                </li>
                            </>
                        )}
                    </ul>
                </div>
            </div>
        </nav>
    );
}

export default Header;
