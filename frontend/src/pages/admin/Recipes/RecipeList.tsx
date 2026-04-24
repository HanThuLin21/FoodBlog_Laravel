import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface Recipe {
  recipe_id: number;
  recipe_name: string;
  recipe_category: string;
  foodtype: string;
  recipe_content: string;
  image2: string;
}

export default function RecipeList() {
  const [recipes, setRecipes] = useState<Recipe[]>([]);
  const [search, setSearch] = useState('');
  const [isLoading, setIsLoading] = useState(true);

  const fetchRecipes = () => {
    setIsLoading(true);
    axios.get('/recipes')
      .then(res => setRecipes(res.data))
      .catch(err => console.error(err))
      .finally(() => setIsLoading(false));
  };

  useEffect(() => {
    fetchRecipes();
  }, []);

  const handleDelete = (id: number) => {
    if (window.confirm("Are you sure you want to delete this recipe?")) {
      axios.delete(`/recipes/${id}`)
        .then(() => {
          setRecipes(recipes.filter(r => r.recipe_id !== id));
        })
        .catch(err => alert('Failed to delete'));
    }
  };

  const filteredRecipes = recipes.filter(r => 
    r.recipe_name.toLowerCase().includes(search.toLowerCase()) || 
    r.recipe_category.toLowerCase().includes(search.toLowerCase()) ||
    r.foodtype.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="admin-card">
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
        <h2>Recipe Management</h2>
        <Link to="/admin/recipes/create" className="admin-btn admin-btn-primary">+ New Recipe</Link>
      </div>
      
      <div style={{ marginBottom: '20px' }}>
        <input 
          type="text" 
          placeholder="Search by name, category, or cuisine..." 
          style={{ width: '100%', padding: '12px', borderRadius: '5px', border: '1px solid #ccc' }}
          value={search}
          onChange={(e) => setSearch(e.target.value)}
        />
      </div>

      {isLoading ? (
        <div>Loading recipes...</div>
      ) : (
        <div className="table-responsive">
          <table className="admin-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Cuisine</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {filteredRecipes.length > 0 ? filteredRecipes.map((recipe, idx) => (
                <tr key={recipe.recipe_id}>
                  <td>{idx + 1}</td>
                  <td>
                    <img src={recipe.image2 ? recipe.image2.replace('../', '/') : ''} alt="Recipe" style={{ width: '80px', height: '60px', objectFit: 'cover' }} onError={(e) => { (e.target as HTMLImageElement).src = 'https://placehold.co/80x60?text=No+Image'; }} />
                  </td>
                  <td>{recipe.recipe_name}</td>
                  <td>{recipe.recipe_category}</td>
                  <td>{recipe.foodtype}</td>
                  <td>
                    <div style={{ display: 'flex', gap: '8px', flexWrap: 'wrap' }}>
                      <Link to={`/admin/recipes/edit/${recipe.recipe_id}`} className="admin-btn admin-btn-primary">Edit</Link>
                      <button onClick={() => handleDelete(recipe.recipe_id)} className="admin-btn admin-btn-danger">Delete</button>
                    </div>
                  </td>
                </tr>
              )) : (
                <tr><td colSpan={6} style={{ textAlign: 'center' }}>No recipes found.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
