import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface Recipe {
  recipe_id: number;
  recipe_name: string;
  image1: string;
}

interface BlogPost {
  post_id: number;
  post_title: string;
  post_description: string;
  post_image: string;
  post_date: string;
}

import { useStylesheet } from '../../hooks/useStylesheet';

export default function Home() {
  useStylesheet('/assets/user/css/style.css');
  const [recipes, setRecipes] = useState<Recipe[]>([]);
  const [posts, setPosts] = useState<BlogPost[]>([]);

  useEffect(() => {
    // Fetch Recipes
    axios.get('http://localhost:8000/api/recipes')
      .then(res => setRecipes(res.data.slice(0, 5)))
      .catch(err => console.error(err));

    // Fetch Blog Posts
    axios.get('http://localhost:8000/api/blogposts')
      .then(res => setPosts(res.data.slice(0, 5)))
      .catch(err => console.error(err));
  }, []);

  return (
    <>
      {/* Hero Section */}
      <section className="hero">
        <div className="hero-content">
          <h1>Delicious Recipes & Food Stories to Savor!</h1>
          <p>Discover mouth-watering recipes, travel food guides, and culinary tips.</p>
          <Link to="/recipes" className="btn">Explore Recipes</Link>
        </div>
      </section>

      {/* Featured Recipes Section */}
      <section className="featured">
        <h2>Featured Recipes</h2>
        <div className="recipes">
          {recipes.map(recipe => (
            <div className="recipe" key={recipe.recipe_id}>
              <img src={recipe.image1} alt={recipe.recipe_name} />
              <h3>{recipe.recipe_name}</h3>
              <Link to={`/recipes/${recipe.recipe_id}`} className="btn-recipe">View Recipe</Link>
            </div>
          ))}
        </div>
      </section>

      {/* Blog Posts Section */}
      <section className="blog">
        <h2>Latest Posts</h2>
        <div className="posts">
          {posts.map(post => (
            <div className="post" key={post.post_id}>
              <div className="post-img">
                <img src={post.post_image} alt={post.post_title} />
              </div>
              <div className="post-context">
                <span>{new Date(post.post_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}</span>
                <h3>{post.post_title}</h3>
                <p>{post.post_description.substring(0, 150)}...</p>
                <Link to={`/blog/${post.post_id}`} className="btn-read">Continue Reading</Link>
              </div>
            </div>
          ))}
        </div>
      </section>
    </>
  );
}
