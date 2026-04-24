import React, { useEffect, useState } from 'react';
import { Outlet, Link, useNavigate, useLocation } from 'react-router-dom';
import '../assets/admin/css/AdminLayout.css';

export default function AdminLayout() {
  const navigate = useNavigate();
  const location = useLocation();
  const [adminName, setAdminName] = useState('Guest');
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

  useEffect(() => {
    const adminStr = localStorage.getItem('admin');
    if (!adminStr) {
      navigate('/admin/login');
    } else {
      try {
        const adminData = JSON.parse(adminStr);
        setAdminName(adminData.user_name || 'Admin');
      } catch (e) {
        navigate('/admin/login');
      }
    }
  }, [navigate]);

  const handleLogout = () => {
    localStorage.removeItem('admin');
    navigate('/admin/login');
  };

  const toggleMobileMenu = () => {
    setIsMobileMenuOpen(!isMobileMenuOpen);
  };

  const closeMobileMenu = () => {
    setIsMobileMenuOpen(false);
  };

  return (
    <div className="admin-layout">
      {/* Mobile Overlay */}
      {isMobileMenuOpen && <div className="admin-sidebar-overlay" onClick={closeMobileMenu}></div>}

      {/* Sidebar */}
      <nav className={`admin-sidebar ${isMobileMenuOpen ? 'open' : ''}`}>
        <div className="admin-logo">
          FoodBlog Admin
        </div>
        <ul className="admin-nav">
          <li>
            <Link to="/admin/dashboard" className={location.pathname.includes('/dashboard') ? 'active' : ''} onClick={closeMobileMenu}>
              <i className="fa-solid fa-house"></i> Dashboard
            </Link>
          </li>
          <li>
            <Link to="/admin/blogposts" className={location.pathname.includes('/blogposts') ? 'active' : ''} onClick={closeMobileMenu}>
              <i className="fa-solid fa-blog"></i> Blog Posts
            </Link>
          </li>
          <li>
            <Link to="/admin/recipes" className={location.pathname.includes('/recipes') ? 'active' : ''} onClick={closeMobileMenu}>
              <i className="fa-solid fa-receipt"></i> Recipes
            </Link>
          </li>
          <li>
            <Link to="/admin/restaurants" className={location.pathname.includes('/restaurants') ? 'active' : ''} onClick={closeMobileMenu}>
              <i className="fa-solid fa-utensils"></i> Restaurants
            </Link>
          </li>
          <li>
            <Link to="/admin/users" className={location.pathname.includes('/users') ? 'active' : ''} onClick={closeMobileMenu}>
              <i className="fa-solid fa-users"></i> Users
            </Link>
          </li>
        </ul>
        <div className="admin-logout" onClick={handleLogout}>
          <i className="fa-solid fa-sign-out-alt"></i> Logout
        </div>
      </nav>

      {/* Main Content Area */}
      <div className="admin-main-wrapper">
        <header className="admin-header">
          <div style={{ display: 'flex', alignItems: 'center', gap: '15px' }}>
            <button className="mobile-menu-btn" onClick={toggleMobileMenu}>
              <i className="fa-solid fa-bars"></i>
            </button>
            <h1>Control Panel</h1>
          </div>
          <div className="admin-header-right">
            <span>Welcome, {adminName}</span>
            <i className="fa-solid fa-user-circle"></i>
          </div>
        </header>

        <main className="admin-content">
          <Outlet />
        </main>
        
        <footer style={{ textAlign: 'center', padding: '20px', color: '#666', borderTop: '1px solid #ddd', marginTop: 'auto' }}>
          <p>&copy; 2025 Created by Bless | All Rights Reserved</p>
        </footer>
      </div>
    </div>
  );
}
