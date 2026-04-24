import React, { useState, useEffect } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';
import axios from 'axios';

export default function BlogForm() {
  const { id } = useParams();
  const isEditing = Boolean(id);
  const navigate = useNavigate();
  
  const [formData, setFormData] = useState({
    title: '',
    category: '',
    foodtype: '',
    desc: '',
    image: '',
    image2: ''
  });
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    if (isEditing) {
      axios.get(`/blogposts/${id}`)
        .then(res => {
          const post = res.data;
          setFormData({
            title: post.post_title,
            category: post.post_category,
            foodtype: post.foodtype,
            desc: post.post_description,
            image: post.post_image,
            image2: post.post_image2
          });
        })
        .catch(err => console.error(err));
    }
  }, [id, isEditing]);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    const apiCall = isEditing 
      ? axios.put(`/blogposts/${id}`, formData)
      : axios.post('/blogposts', formData);

    apiCall
      .then(() => {
        navigate('/admin/blogposts');
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
        <h2>{isEditing ? 'Edit Blog Post' : 'Create New Blog Post'}</h2>
        <Link to="/admin/blogposts" className="admin-btn" style={{ background: '#95a5a6', color: 'white' }}>Back to List</Link>
      </div>

      <form onSubmit={handleSubmit}>
        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Title</label>
          <input 
            type="text" name="title" value={formData.title} onChange={handleChange} required 
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
          />
        </div>

        <div style={{ display: 'flex', gap: '20px', marginBottom: '15px' }}>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Category</label>
            <input 
              type="text" name="category" value={formData.category} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Cuisine Type</label>
            <input 
              type="text" name="foodtype" value={formData.foodtype} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
        </div>

        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Image URL 1</label>
          <input 
            type="text" name="image" value={formData.image} onChange={handleChange} 
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
          />
        </div>

        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Image URL 2</label>
          <input 
            type="text" name="image2" value={formData.image2} onChange={handleChange} 
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
          />
        </div>

        <div style={{ marginBottom: '20px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Description / Content</label>
          <textarea 
            name="desc" value={formData.desc} onChange={handleChange} required rows={8}
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc', resize: 'vertical' }}
          ></textarea>
        </div>

        <button type="submit" className="admin-btn admin-btn-primary" disabled={isLoading} style={{ width: '100%' }}>
          {isLoading ? 'Saving...' : (isEditing ? 'Update Blog Post' : 'Publish Blog Post')}
        </button>
      </form>
    </div>
  );
}
