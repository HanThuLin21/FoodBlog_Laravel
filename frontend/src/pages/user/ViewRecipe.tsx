import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { useStylesheet } from '../../hooks/useStylesheet';

interface RecipeType {
  recipe_id: number;
  recipe_name: string;
  recipe_category: string;
  foodtype: string;
  image1: string;
  image2: string;
  image3: string;
  recipe_content: string;
  prep_time: string;
  cook_time: string;
  servings: number;
  instructions: string;
}

interface RestaurantType {
  restaurant_id: number;
  restaurant_name: string;
  restaurant_phone: string;
  restaurant_location: string;
  foodtype: string;
}

export default function ViewRecipe() {
  useStylesheet('/assets/user/css/ViewRecipe.css');
  const { id } = useParams<{ id: string }>();
  const [recipe, setRecipe] = useState<RecipeType | null>(null);
  const [restaurants, setRestaurants] = useState<RestaurantType[]>([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    setIsLoading(true);
    // Fetch recipe details
    axios.get(`/recipes/${id}`)
      .then(res => {
        setRecipe(res.data);
        // Fetch all restaurants and filter by foodtype locally
        return axios.get('/restaurants');
      })
      .then(res => {
        if (recipe) {
           const filtered = res.data.filter((r: RestaurantType) => r.foodtype === recipe.foodtype);
           setRestaurants(filtered);
        } else {
           // If recipe state wasn't updated yet, we can filter using the previous response
        }
      })
      .catch(err => console.error(err))
      .finally(() => setIsLoading(false));
  }, [id]);

  // A more robust way to handle the dependent fetch:
  useEffect(() => {
    if (recipe) {
      axios.get('/restaurants')
        .then(res => {
          const filtered = res.data.filter((r: RestaurantType) => r.foodtype === recipe.foodtype);
          setRestaurants(filtered);
        })
        .catch(err => console.error(err));
    }
  }, [recipe?.foodtype]);

  if (isLoading) {
    return (
      <div style={{ textAlign: 'center', padding: '100px', fontSize: '1.2rem', color: '#666' }}>
        <i className="fa-solid fa-spinner fa-spin" style={{ marginRight: '10px' }}></i>
        Loading recipe details...
      </div>
    );
  }

  if (!recipe) {
    return <div style={{ textAlign: 'center', padding: '100px' }}>Recipe not found.</div>;
  }

  return (
    <>
      <div className="recipe-container">
        <h1 className="title">{recipe.recipe_name}</h1>
        <div className="recipe-info">
          <p><strong>Description:</strong> {recipe.recipe_content}</p>
          <p><strong>Preparation Time:</strong> {recipe.prep_time}</p>
          <p><strong>Cooking Time:</strong> {recipe.cook_time}</p>
          <p><strong>Servings:</strong> {recipe.servings}</p>
        </div>

        <div className="image-grid">
          {recipe.image2 && <img src={recipe.image2} alt={recipe.recipe_name + " 1"} />}
          {recipe.image3 && <img src={recipe.image3} alt={recipe.recipe_name + " 2"} />}
        </div>

        <div className="instructions">
          <h2>Instructions</h2>
          <ol>
            {recipe.instructions.split('\n').map((instruction, index) => (
              instruction.trim() !== '' && <li key={index} style={{ marginBottom: '10px' }}>{instruction}</li>
            ))}
          </ol>
        </div>

        <div className="where-to-buy">
          <h2>Where to Buy {recipe.recipe_name}</h2>
          <p>These restaurants serve {recipe.recipe_name}:</p>
          <ul>
            {restaurants.length > 0 ? (
              restaurants.map(restaurant => (
                <li key={restaurant.restaurant_id}>
                  <strong>{restaurant.restaurant_name}</strong><br />
                  Phone: {restaurant.restaurant_phone}<br />
                  Location: {restaurant.restaurant_location}
                </li>
              ))
            ) : (
              <li>No restaurants found for this recipe.</li>
            )}
          </ul>
        </div>
      </div>
    </>
  );
}
