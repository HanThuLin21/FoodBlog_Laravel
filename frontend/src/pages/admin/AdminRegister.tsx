import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { useStylesheet } from '../../hooks/useStylesheet';

export default function AdminRegister() {
  useStylesheet('/assets/user/css/Auth.css');
  const [formData, setFormData] = useState({
    username: '',
    email: '',
    password: '',
    conpassword: ''
  });
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const navigate = useNavigate();

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFormData({
      ...formData,
      [e.target.id]: e.target.value
    });
  };

  const handleRegister = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setSuccess('');

    if (formData.password !== formData.conpassword) {
      setError("Passwords do not match");
      return;
    }

    setIsLoading(true);

    try {
      const response = await axios.post('/admin/register', {
        username: formData.username,
        email: formData.email,
        password: formData.password,
        conpassword: formData.conpassword
      });

      if (response.data.admin) {
        setSuccess('Admin Registration successful! Redirecting to login...');
        setTimeout(() => {
          navigate('/admin/login');
        }, 2000);
      }
    } catch (err: any) {
      if (err.response && err.response.data && err.response.data.message) {
        setError(err.response.data.message);
      } else {
        setError('Registration failed. Please check your inputs.');
      }
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="auth-container">
      <div className="auth-header">
        <img src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Delicious Bites" />
        <h2>Admin Register</h2>
      </div>

      <div className="auth-form-wrapper">
        {error && <div className="auth-error">{error}</div>}
        {success && <div className="auth-error" style={{ backgroundColor: '#def7ec', color: '#03543f', border: '1px solid #31c48d' }}>{success}</div>}
        
        <form onSubmit={handleRegister}>
          <div className="auth-form-group">
            <label htmlFor="username" className="auth-label">Admin Username</label>
            <input 
              type="text" 
              id="username" 
              className="auth-input" 
              required 
              value={formData.username}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group">
            <label htmlFor="email" className="auth-label">Email address</label>
            <input 
              type="email" 
              id="email" 
              className="auth-input" 
              required 
              value={formData.email}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group">
            <label htmlFor="password" className="auth-label">Password</label>
            <input 
              type="password" 
              id="password" 
              className="auth-input" 
              required 
              value={formData.password}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group">
            <label htmlFor="conpassword" className="auth-label">Confirm Password</label>
            <input 
              type="password" 
              id="conpassword" 
              className="auth-input" 
              required 
              value={formData.conpassword}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group" style={{ marginTop: '2rem' }}>
            <button type="submit" className="auth-btn" disabled={isLoading}>
              {isLoading ? 'Registering...' : 'Register as Admin'}
            </button>
          </div>
        </form>

        <p className="auth-footer">
          Already have an account?{' '}
          <Link to="/admin/login" className="auth-link">Login here</Link>
        </p>
      </div>
    </div>
  );
}
