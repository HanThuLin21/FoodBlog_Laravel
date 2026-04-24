import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface RestaurantType {
  restaurant_id: number;
  restaurant_name: string;
  foodtype: string;
  restaurant_content: string;
  restaurant_image: string;
  restaurant_rating: number;
}

import { useStylesheet } from '../../hooks/useStylesheet';

export default function Restaurant() {
  useStylesheet('/assets/user/css/Restaurentstyle.css');
  const [restaurants, setRestaurants] = useState<RestaurantType[]>([]);
  const [searchTerm, setSearchTerm] = useState('');

  useEffect(() => {
    axios.get('http://localhost:8000/api/restaurants')
      .then(res => setRestaurants(res.data))
      .catch(err => console.error(err));
  }, []);

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
  };

  const filteredRestaurants = restaurants.filter(restaurant => 
    restaurant.restaurant_name.toLowerCase().includes(searchTerm.toLowerCase()) || 
    restaurant.restaurant_rating.toString().includes(searchTerm) ||
    restaurant.foodtype.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const getStars = (rating: number) => {
    if (rating >= 5) return "★★★★★";
    if (rating == 4) return "★★★★☆";
    if (rating == 3) return "★★★☆☆";
    if (rating == 2) return "★★☆☆☆";
    if (rating == 1) return "★☆☆☆☆";
    return "☆☆☆☆☆";
  };

  return (
    <>
      <div className="hero">
        <div>
          <h3>Top Restaurant Recommendations</h3>
          <form className="search-box" onSubmit={handleSearch}>
            <input 
              type="text" 
              name="search" 
              placeholder="Search Restaurant" 
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
            <button type="submit">Search</button>
          </form>
        </div>
      </div>
      
      <div className="content">
        <h2>Recommended Restaurants</h2>
        <div className="restaurants">
          {filteredRestaurants.length > 0 ? (
            filteredRestaurants.map(restaurant => (
              <div className="restaurant-item" key={restaurant.restaurant_id}>
                <img src={restaurant.restaurant_image} alt={restaurant.restaurant_name} />
                <h3>{restaurant.restaurant_name}</h3>
                <p>{restaurant.restaurant_content.substring(0, 120)} ...</p>
                <div className="rating">
                  {getStars(restaurant.restaurant_rating)}
                </div>
                <Link to={`/restaurants/${restaurant.restaurant_id}`} className="view">View Restaurant</Link>
              </div>
            ))
          ) : (
            <p className="no-results">No restaurants found matching your search.</p>
          )}
        </div>
      </div>
    </>
  );
}
