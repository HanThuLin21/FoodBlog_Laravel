import React, { useState, useEffect } from 'react';
import { Outlet, Link, useNavigate } from 'react-router-dom';
import '../../public/assets/user/css/Navbar.css';

export default function UserLayout() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [user, setUser] = useState<{user_name: string} | null>(null);
  const navigate = useNavigate();

  useEffect(() => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      try {
        setUser(JSON.parse(storedUser));
      } catch (e) {
        // invalid json
      }
    }
  }, []);

  const handleLogout = () => {
    localStorage.removeItem('user');
    setUser(null);
    navigate('/');
  };

  return (
    <>
      <header>
        <div className="container">
          <h1 className="logo">Delicious Bites</h1>
          <div 
            className="hamburger" 
            id="hamburger" 
            onClick={() => setIsMenuOpen(!isMenuOpen)}
          >
            <span></span>
            <span></span>
            <span></span>
          </div>
          <nav id="nav-menu">
            <ul className={`nav-list ${isMenuOpen ? 'active' : ''}`}>
              <li><Link to="/" onClick={() => setIsMenuOpen(false)}>Home</Link></li>
              <li><Link to="/blog" onClick={() => setIsMenuOpen(false)}>Blogs</Link></li>
              <li><Link to="/recipes" onClick={() => setIsMenuOpen(false)}>Recipes</Link></li>
              <li><Link to="/restaurants" onClick={() => setIsMenuOpen(false)}>Restaurant</Link></li>
              <li><Link to="/about" onClick={() => setIsMenuOpen(false)}>About</Link></li>
              
              {user ? (
                <li className="dropdown">
                  <div className="user_account">
                    <i className="fa-solid fa-user" style={{ fontSize: '20px' }}></i> {user.user_name}
                  </div>
                  <ul className="dropdown-menu">
                    <li><Link to="/register">New Account</Link></li>
                    <li><a href="#" onClick={(e) => { e.preventDefault(); handleLogout(); }}>Logout</a></li>
                  </ul>
                </li>
              ) : (
                <li className="dropdown">
                  <a href="#" className="btn-signup" onClick={(e) => e.preventDefault()}>Account <i className="fa-solid fa-caret-down"></i></a>
                  <ul className="dropdown-menu">
                    <li><Link to="/login">Log in</Link></li>
                    <li><Link to="/register">Register</Link></li>
                  </ul>
                </li>
              )}
            </ul>
          </nav>
        </div>
      </header>

      <main>
        <Outlet />
      </main>

      <footer>
        <section className="subscribe">
          <h2>Subscribe for Weekly Recipes!</h2>
          <form action="#" method="post" onSubmit={(e) => e.preventDefault()}>
            <input type="email" placeholder="Enter your email" required />
            <button type="submit">Subscribe</button>
          </form>
        </section>
        <div className="social-media">
          <a href="#"><i className="fab fa-facebook-f"></i></a>
          <a href="#"><i className="fab fa-twitter"></i></a>
          <a href="#"><i className="fab fa-instagram"></i></a>
          <a href="#"><i className="fab fa-pinterest"></i></a>
        </div>
        <p>&copy; 2025 Created by Bless | All Rights Reserved</p>
      </footer>
    </>
  );
}
