import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface Restaurant {
  restaurant_id: number;
  restaurant_name: string;
  foodtype: string;
  restaurant_location: string;
  restaurant_image2: string;
}

export default function RestaurantList() {
  const [restaurants, setRestaurants] = useState<Restaurant[]>([]);
  const [search, setSearch] = useState('');
  const [isLoading, setIsLoading] = useState(true);

  const fetchRestaurants = () => {
    setIsLoading(true);
    axios.get('http://localhost:8000/api/restaurants')
      .then(res => setRestaurants(res.data))
      .catch(err => console.error(err))
      .finally(() => setIsLoading(false));
  };

  useEffect(() => {
    fetchRestaurants();
  }, []);

  const handleDelete = (id: number) => {
    if (window.confirm("Are you sure you want to delete this restaurant?")) {
      axios.delete(`http://localhost:8000/api/restaurants/${id}`)
        .then(() => {
          setRestaurants(restaurants.filter(r => r.restaurant_id !== id));
        })
        .catch(err => alert('Failed to delete'));
    }
  };

  const filteredRestaurants = restaurants.filter(r => 
    r.restaurant_name.toLowerCase().includes(search.toLowerCase()) || 
    r.foodtype.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="admin-card">
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
        <h2>Restaurant Management</h2>
        <Link to="/admin/restaurants/create" className="admin-btn admin-btn-primary">+ New Restaurant</Link>
      </div>
      
      <div style={{ marginBottom: '20px' }}>
        <input 
          type="text" 
          placeholder="Search by name or cuisine..." 
          style={{ width: '100%', padding: '12px', borderRadius: '5px', border: '1px solid #ccc' }}
          value={search}
          onChange={(e) => setSearch(e.target.value)}
        />
      </div>

      {isLoading ? (
        <div>Loading restaurants...</div>
      ) : (
        <div className="table-responsive">
          <table className="admin-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Restaurant Type</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {filteredRestaurants.length > 0 ? filteredRestaurants.map((rest, idx) => (
                <tr key={rest.restaurant_id}>
                  <td>{idx + 1}</td>
                  <td>
                    <img src={rest.restaurant_image2 ? rest.restaurant_image2.replace('../', '/') : ''} alt="Restaurant" style={{ width: '80px', height: '60px', objectFit: 'cover' }} onError={(e) => { (e.target as HTMLImageElement).src = 'https://placehold.co/80x60?text=No+Image'; }} />
                  </td>
                  <td>{rest.restaurant_name}</td>
                  <td>{rest.foodtype}</td>
                  <td>
                    <div style={{ display: 'flex', gap: '8px', flexWrap: 'wrap' }}>
                      <Link to={`/admin/restaurants/edit/${rest.restaurant_id}`} className="admin-btn admin-btn-primary">Edit</Link>
                      <button onClick={() => handleDelete(rest.restaurant_id)} className="admin-btn admin-btn-danger">Delete</button>
                    </div>
                  </td>
                </tr>
              )) : (
                <tr><td colSpan={5} style={{ textAlign: 'center' }}>No restaurants found.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
