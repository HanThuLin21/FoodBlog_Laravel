import React, { useState, useEffect } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';
import axios from 'axios';

export default function RestaurantForm() {
  const { id } = useParams();
  const isEditing = Boolean(id);
  const navigate = useNavigate();
  
  const [formData, setFormData] = useState({
    name: '',
    phone: '',
    foodtype: '',
    location: '',
    content: '',
    image: '',
    image2: '',
    image3: '',
    rate: '',
    day: '',
    opentime: '',
    closetime: ''
  });
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    if (isEditing) {
      axios.get(`http://localhost:8000/api/restaurants/${id}`)
        .then(res => {
          const rest = res.data;
          setFormData({
            name: rest.restaurant_name,
            phone: rest.restaurant_phone,
            foodtype: rest.foodtype,
            location: rest.restaurant_location,
            content: rest.restaurant_content,
            image: rest.restaurant_image || '',
            image2: rest.restaurant_image2 || '',
            image3: rest.restaurant_image3 || '',
            rate: rest.restaurant_rating || '',
            day: rest.opening_day || '',
            opentime: rest.open_hour || '',
            closetime: rest.close_hour || ''
          });
        })
        .catch(err => console.error(err));
    }
  }, [id, isEditing]);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    // Note: Our update API expects 'type' and 'rating' instead of 'foodtype' and 'rate' due to a quirk in the backend update function
    const payload = isEditing ? {
        ...formData,
        type: formData.foodtype,
        rating: formData.rate
    } : formData;

    const apiCall = isEditing 
      ? axios.put(`http://localhost:8000/api/restaurants/${id}`, payload)
      : axios.post('http://localhost:8000/api/restaurants', payload);

    apiCall
      .then(() => {
        navigate('/admin/restaurants');
      })
      .catch(err => {
        console.error(err);
        alert('An error occurred while saving.');
      })
      .finally(() => setIsLoading(false));
  };

  return (
    <div className="admin-card" style={{ maxWidth: '800px', margin: '0 auto' }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
        <h2>{isEditing ? 'Edit Restaurant' : 'Create New Restaurant'}</h2>
        <Link to="/admin/restaurants" className="admin-btn" style={{ background: '#95a5a6', color: 'white' }}>Back to List</Link>
      </div>

      <form onSubmit={handleSubmit}>
        <div style={{ display: 'flex', gap: '20px', marginBottom: '15px' }}>
          <div style={{ flex: 2 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Restaurant Name</label>
            <input 
              type="text" name="name" value={formData.name} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Phone</label>
            <input 
              type="text" name="phone" value={formData.phone} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
        </div>

        <div style={{ display: 'flex', gap: '20px', marginBottom: '15px' }}>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Restaurant Type (Cuisine)</label>
            <input 
              type="text" name="foodtype" value={formData.foodtype} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Rating (1-5)</label>
            <input 
              type="number" step="0.1" name="rate" value={formData.rate} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
        </div>

        <div style={{ display: 'flex', gap: '20px', marginBottom: '15px' }}>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Opening Days (e.g. Mon-Fri)</label>
            <input 
              type="text" name="day" value={formData.day} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Open Hour</label>
            <input 
              type="time" name="opentime" value={formData.opentime} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Close Hour</label>
            <input 
              type="time" name="closetime" value={formData.closetime} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
        </div>

        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Location / Address</label>
          <input 
            type="text" name="location" value={formData.location} onChange={handleChange} required 
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
          />
        </div>

        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Description (About Us)</label>
          <textarea 
            name="content" value={formData.content} onChange={handleChange} required rows={4}
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc', resize: 'vertical' }}
          ></textarea>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr 1fr', gap: '15px', marginBottom: '20px' }}>
          <div>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Main Image URL</label>
            <input type="text" name="image" value={formData.image} onChange={handleChange} style={{ width: '100%', padding: '8px', border: '1px solid #ccc' }} />
          </div>
          <div>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Banner Image URL</label>
            <input type="text" name="image2" value={formData.image2} onChange={handleChange} style={{ width: '100%', padding: '8px', border: '1px solid #ccc' }} />
          </div>
          <div>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Interior Image URL</label>
            <input type="text" name="image3" value={formData.image3} onChange={handleChange} style={{ width: '100%', padding: '8px', border: '1px solid #ccc' }} />
          </div>
        </div>

        <button type="submit" className="admin-btn admin-btn-primary" disabled={isLoading} style={{ width: '100%' }}>
          {isLoading ? 'Saving...' : (isEditing ? 'Update Restaurant' : 'Publish Restaurant')}
        </button>
      </form>
    </div>
  );
}
