import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { useStylesheet } from '../../hooks/useStylesheet';

export default function AdminLogin() {
  useStylesheet('/assets/user/css/Auth.css');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const navigate = useNavigate();

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setIsLoading(true);

    try {
      const response = await axios.post('http://localhost:8000/api/admin/login', {
        email,
        password
      });

      if (response.data.admin) {
        localStorage.setItem('admin', JSON.stringify(response.data.admin));
        // Force reload or redirect to admin dashboard
        window.location.href = '/admin/dashboard';
      }
    } catch (err: any) {
      if (err.response && err.response.data && err.response.data.message) {
        setError(err.response.data.message);
      } else {
        setError('Login failed. Please check your admin credentials.');
      }
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="auth-container">
      <div className="auth-header">
        <img src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Delicious Bites" />
        <h2>Admin Login</h2>
      </div>

      <div className="auth-form-wrapper">
        {error && <div className="auth-error">{error}</div>}
        <form onSubmit={handleLogin}>
          <div className="auth-form-group">
            <label htmlFor="email" className="auth-label">Admin Email</label>
            <input 
              type="email" 
              id="email" 
              className="auth-input" 
              required 
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>

          <div className="auth-form-group">
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.5rem' }}>
              <label htmlFor="password" style={{ margin: 0 }} className="auth-label">Password</label>
            </div>
            <input 
              type="password" 
              id="password" 
              className="auth-input" 
              required 
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          <div className="auth-form-group" style={{ marginTop: '2rem' }}>
            <button type="submit" className="auth-btn" disabled={isLoading}>
              {isLoading ? 'Verifying...' : 'Login to Dashboard'}
            </button>
          </div>
        </form>

        <p className="auth-footer">
          New Administrator?{' '}
          <Link to="/admin/register" className="auth-link">Register here</Link>
        </p>
      </div>
    </div>
  );
}
