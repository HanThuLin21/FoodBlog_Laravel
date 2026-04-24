import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { useStylesheet } from '../../hooks/useStylesheet';

interface RestaurantType {
  restaurant_id: number;
  restaurant_name: string;
  restaurant_phone: string;
  restaurant_location: string;
  foodtype: string;
  restaurant_content: string;
  restaurant_image: string;
  restaurant_image2: string;
  restaurant_image3: string;
  restaurant_rating: number;
  opening_day: string;
  open_hour: string;
  close_hour: string;
}

interface RecipeType {
  recipe_id: number;
  recipe_name: string;
  recipe_category: string;
  foodtype: string;
  image2: string;
  recipe_content: string;
}

export default function SeeViewRestaurant() {
  useStylesheet('/assets/user/css/SeeViewRestaurant.css');
  const { id } = useParams<{ id: string }>();
  const [restaurant, setRestaurant] = useState<RestaurantType | null>(null);
  const [recipes, setRecipes] = useState<RecipeType[]>([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    setIsLoading(true);
    // Fetch restaurant details
    axios.get(`/restaurants/${id}`)
      .then(res => {
        setRestaurant(res.data);
      })
      .catch(err => console.error(err))
      .finally(() => setIsLoading(false));
  }, [id]);

  useEffect(() => {
    if (restaurant) {
      axios.get('/recipes')
        .then(res => {
          const filtered = res.data.filter((r: RecipeType) => r.foodtype === restaurant.foodtype);
          setRecipes(filtered);
        })
        .catch(err => console.error(err));
    }
  }, [restaurant?.foodtype]);

  // Format time (e.g., "10:00:00" to "10:00 AM")
  const formatTime = (timeStr: string) => {
    if (!timeStr) return "N/A";
    try {
      const [hours, minutes] = timeStr.split(':');
      let h = parseInt(hours, 10);
      const ampm = h >= 12 ? 'PM' : 'AM';
      h = h % 12;
      h = h ? h : 12; 
      return `${h}:${minutes} ${ampm}`;
    } catch (e) {
      return timeStr;
    }
  };

  const renderStars = (rating: number) => {
    const stars = [];
    for (let i = 1; i <= 5; i++) {
      stars.push(
        <span key={i}>
          {i <= rating ? '★' : '☆'}
        </span>
      );
    }
    return stars;
  };

  if (isLoading) {
    return (
      <div style={{ textAlign: 'center', padding: '100px', fontSize: '1.2rem', color: '#666' }}>
        <i className="fa-solid fa-spinner fa-spin" style={{ marginRight: '10px' }}></i>
        Loading restaurant details...
      </div>
    );
  }

  if (!restaurant) {
    return <div style={{ textAlign: 'center', padding: '100px' }}>Restaurant not found.</div>;
  }

  return (
    <>
      <img src={restaurant.restaurant_image2} alt="Top Banner" className="top-image" />
      
      <div className="restaurant-container">
        <h1>{restaurant.restaurant_name}</h1>
        
        <section className="about">
          <h2>About Us</h2>
          <p>{restaurant.restaurant_content}</p>
          <img src={restaurant.restaurant_image3} alt="Restaurant Interior" />
        </section>
        
        <section className="menu">
          <h2>Famous Menu</h2>
          <p>Explore our handcrafted dishes made from locally sourced ingredients.</p>
          <div className="menu-container">
            {recipes.length > 0 ? (
              recipes.map(recipe => (
                <div className="menu-item" key={recipe.recipe_id}>
                  <img src={recipe.image2} alt={recipe.recipe_name} />
                  <h3>{recipe.recipe_name}</h3>
                  <p>{recipe.recipe_content.substring(0, 100)}...</p>
                </div>
              ))
            ) : (
              <p>No menu items found.</p>
            )}
          </div>
        </section>
        
        <section className="details">
          <div className="info">
            <h2>Visit Us</h2>
            <p><strong>Opening Days: </strong> {restaurant.opening_day}</p>
            <p><strong>Open Hour: </strong> {formatTime(restaurant.open_hour)}</p>
            <p><strong>Close Hour: </strong> {formatTime(restaurant.close_hour)}</p>
            <p><strong>Address: </strong>{restaurant.restaurant_location}</p>
            <p><strong>Rating: </strong> 
              <span className="stars" style={{ color: '#FFD700', fontSize: '20px' }}>
                {renderStars(restaurant.restaurant_rating)}
              </span> ({restaurant.restaurant_rating}/5)
            </p>
          </div>
        </section>
      </div>
    </>
  );
}
