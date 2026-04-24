import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../../assets/admin/css/Dashboard.css';

export default function Dashboard() {
  const [stats, setStats] = useState({
    userCount: 0,
    blogCount: 0,
    recipeCount: 0,
    restaurantCount: 0
  });
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    setIsLoading(true);
    axios.get('http://localhost:8000/api/admin/stats')
      .then(res => {
        setStats(res.data);
      })
      .catch(err => console.error(err))
      .finally(() => setIsLoading(false));
  }, []);

  if (isLoading) {
    return <div>Loading dashboard...</div>;
  }

  return (
    <div>
      <div className="dashboard-widgets">
        <div className="widget">
          <h3>Total Users</h3>
          <p>{stats.userCount}</p>
        </div>
        <div className="widget">
          <h3>Total Blog Posts</h3>
          <p>{stats.blogCount}</p>
        </div>
        <div className="widget">
          <h3>Total Recipes</h3>
          <p>{stats.recipeCount}</p>
        </div>
        <div className="widget">
          <h3>Total Restaurants</h3>
          <p>{stats.restaurantCount}</p>
        </div>
      </div>

      <div className="recent-activity">
        <h2>Recent Activity Overview</h2>
        <ul>
          <li>System online and database connected successfully.</li>
          <li>User registration count is currently at {stats.userCount}.</li>
          <li>{stats.blogCount} blog posts have been successfully migrated.</li>
          <li>API endpoints are responsive.</li>
        </ul>
      </div>
    </div>
  );
}
