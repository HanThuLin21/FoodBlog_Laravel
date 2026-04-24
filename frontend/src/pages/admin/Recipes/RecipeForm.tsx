import React, { useState, useEffect } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';
import axios from 'axios';

export default function RecipeForm() {
  const { id } = useParams();
  const isEditing = Boolean(id);
  const navigate = useNavigate();
  
  const [formData, setFormData] = useState({
    name: '',
    category: '',
    foodtype: '',
    content: '',
    preptime: '',
    cooktime: '',
    servings: '',
    instructions: '',
    image1: '',
    image2: '',
    image3: ''
  });
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    if (isEditing) {
      axios.get(`/recipes/${id}`)
        .then(res => {
          const recipe = res.data;
          setFormData({
            name: recipe.recipe_name,
            category: recipe.recipe_category,
            foodtype: recipe.foodtype,
            content: recipe.recipe_content,
            preptime: recipe.prep_time,
            cooktime: recipe.cook_time,
            servings: recipe.servings,
            instructions: recipe.instructions,
            image1: recipe.image1,
            image2: recipe.image2,
            image3: recipe.image3
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

    const apiCall = isEditing 
      ? axios.put(`/recipes/${id}`, formData)
      : axios.post('/recipes', formData);

    apiCall
      .then(() => {
        navigate('/admin/recipes');
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
        <h2>{isEditing ? 'Edit Recipe' : 'Create New Recipe'}</h2>
        <Link to="/admin/recipes" className="admin-btn" style={{ background: '#95a5a6', color: 'white' }}>Back to List</Link>
      </div>

      <form onSubmit={handleSubmit}>
        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Recipe Name</label>
          <input 
            type="text" name="name" value={formData.name} onChange={handleChange} required 
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

        <div style={{ display: 'flex', gap: '20px', marginBottom: '15px' }}>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Prep Time</label>
            <input 
              type="text" name="preptime" value={formData.preptime} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Cook Time</label>
            <input 
              type="text" name="cooktime" value={formData.cooktime} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Servings</label>
            <input 
              type="number" name="servings" value={formData.servings} onChange={handleChange} required 
              style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc' }}
            />
          </div>
        </div>

        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Description</label>
          <textarea 
            name="content" value={formData.content} onChange={handleChange} required rows={3}
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc', resize: 'vertical' }}
          ></textarea>
        </div>

        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Instructions (One per line)</label>
          <textarea 
            name="instructions" value={formData.instructions} onChange={handleChange} required rows={5}
            style={{ width: '100%', padding: '10px', borderRadius: '5px', border: '1px solid #ccc', resize: 'vertical' }}
          ></textarea>
        </div>

        <div style={{ display: 'flex', gap: '10px', marginBottom: '20px' }}>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Image 1 URL</label>
            <input type="text" name="image1" value={formData.image1} onChange={handleChange} style={{ width: '100%', padding: '8px', border: '1px solid #ccc' }} />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Image 2 URL</label>
            <input type="text" name="image2" value={formData.image2} onChange={handleChange} style={{ width: '100%', padding: '8px', border: '1px solid #ccc' }} />
          </div>
          <div style={{ flex: 1 }}>
            <label style={{ display: 'block', marginBottom: '5px', fontWeight: 'bold' }}>Image 3 URL</label>
            <input type="text" name="image3" value={formData.image3} onChange={handleChange} style={{ width: '100%', padding: '8px', border: '1px solid #ccc' }} />
          </div>
        </div>

        <button type="submit" className="admin-btn admin-btn-primary" disabled={isLoading} style={{ width: '100%' }}>
          {isLoading ? 'Saving...' : (isEditing ? 'Update Recipe' : 'Publish Recipe')}
        </button>
      </form>
    </div>
  );
}
