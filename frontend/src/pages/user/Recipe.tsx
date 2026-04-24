import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface RecipeType {
  recipe_id: number;
  recipe_name: string;
  recipe_category: string;
  foodtype: string;
  recipe_content: string;
  image1: string;
}

import { useStylesheet } from '../../hooks/useStylesheet';

export default function Recipe() {
  useStylesheet('/assets/user/css/RecipeStyle.css');
  const [recipes, setRecipes] = useState<RecipeType[]>([]);
  const [searchTerm, setSearchTerm] = useState('');

  useEffect(() => {
    axios.get('/recipes')
      .then(res => setRecipes(res.data))
      .catch(err => console.error(err));
  }, []);

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    // Search is handled locally by filtering the state to avoid unnecessary API calls
  };

  const filteredRecipes = recipes.filter(recipe => 
    recipe.recipe_name.toLowerCase().includes(searchTerm.toLowerCase()) || 
    recipe.recipe_category.toLowerCase().includes(searchTerm.toLowerCase()) ||
    recipe.foodtype.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <>
      {/* Hero Section */}
      <section className="hero">
        <div className="hero-section">
          <h2>Welcome to Our Recipe Collection!</h2>
          <p>Discover mouth-watering recipes to satisfy your cravings.</p>
          <form className="search-box" onSubmit={handleSearch}>
            <input 
              type="text" 
              name="search" 
              placeholder="Search Recipe" 
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
            <button type="submit">Search</button>
          </form>
        </div>
      </section>

      {/* Recipe Section */}
      <section className="recipes">
        <h1>Featured Recipes</h1>
        <div className="recipe-section">
          {filteredRecipes.length > 0 ? (
            filteredRecipes.map(recipe => (
              <div className="recipe-card" key={recipe.recipe_id}>
                <img src={recipe.image1} alt={recipe.recipe_name} />
                <h2>{recipe.recipe_name}</h2>
                <p>{recipe.recipe_content.substring(0, 120)}...</p>
                <Link to={`/recipes/${recipe.recipe_id}`}>View Recipe</Link>
              </div>
            ))
          ) : (
            <p className="no-results">No recipes found matching your search.</p>
          )}
        </div>
      </section>
    </>
  );
}
