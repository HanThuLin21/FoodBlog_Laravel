import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { useStylesheet } from '../../hooks/useStylesheet';

export default function UserRegister() {
  useStylesheet('/assets/user/css/Auth.css');
  const [formData, setFormData] = useState({
    username: '',
    email: '',
    phone: '',
    password: '',
    conpass: ''
  });
  const [error, setError] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const navigate = useNavigate();

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleRegister = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    
    if (formData.password !== formData.conpass) {
      setError('Passwords do not match');
      return;
    }

    setIsLoading(true);

    try {
      const response = await axios.post('/user/register', {
        username: formData.username,
        email: formData.email,
        phone: formData.phone,
        password: formData.password,
        conpass: formData.conpass
      });

      if (response.data.user) {
        localStorage.setItem('user', JSON.stringify(response.data.user));
        window.location.href = '/';
      }
    } catch (err: any) {
      if (err.response && err.response.data && err.response.data.message) {
        setError(err.response.data.message);
      } else if (err.response && err.response.data && err.response.data.errors) {
        // Handle validation errors from Laravel
        const errorMessages = Object.values(err.response.data.errors).flat().join('\n');
        setError(errorMessages);
      } else {
        setError('Registration failed. Please try again.');
      }
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="auth-container">
      <div className="auth-header">
        <img src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Delicious Bites" />
        <h2>Register for user account</h2>
      </div>

      <div className="auth-form-wrapper">
        {error && <div className="auth-error">{error}</div>}
        <form onSubmit={handleRegister}>
          <div className="auth-form-group">
            <label htmlFor="username" className="auth-label">User Name</label>
            <input 
              type="text" 
              id="username" 
              name="username"
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
              name="email"
              className="auth-input" 
              required 
              value={formData.email}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group">
            <label htmlFor="phone" className="auth-label">Phone Number</label>
            <input 
              type="text" 
              id="phone" 
              name="phone"
              className="auth-input" 
              required 
              value={formData.phone}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group">
            <label htmlFor="password" className="auth-label">Password</label>
            <input 
              type="password" 
              id="password" 
              name="password"
              className="auth-input" 
              required 
              value={formData.password}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group">
            <label htmlFor="conpass" className="auth-label">Confirm Password</label>
            <input 
              type="password" 
              id="conpass" 
              name="conpass"
              className="auth-input" 
              required 
              value={formData.conpass}
              onChange={handleChange}
            />
          </div>

          <div className="auth-form-group" style={{ marginTop: '2rem' }}>
            <button type="submit" className="auth-btn" disabled={isLoading}>
              {isLoading ? 'Registering...' : 'Register'}
            </button>
          </div>
        </form>

        <p className="auth-footer">
          Already have an account?{' '}
          <Link to="/login" className="auth-link">Login Here</Link>
        </p>
      </div>
    </div>
  );
}
