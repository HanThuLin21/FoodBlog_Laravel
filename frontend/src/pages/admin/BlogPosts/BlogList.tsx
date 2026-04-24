import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface BlogPost {
  post_id: number;
  post_title: string;
  post_category: string;
  foodtype: string;
  post_description: string;
  post_date: string;
  post_image: string;
}

export default function BlogList() {
  const [blogs, setBlogs] = useState<BlogPost[]>([]);
  const [search, setSearch] = useState('');
  const [isLoading, setIsLoading] = useState(true);

  const fetchBlogs = () => {
    setIsLoading(true);
    axios.get('/blogposts')
      .then(res => setBlogs(res.data))
      .catch(err => console.error(err))
      .finally(() => setIsLoading(false));
  };

  useEffect(() => {
    fetchBlogs();
  }, []);

  const handleDelete = (id: number) => {
    if (window.confirm("Are you sure you want to delete this blog post?")) {
      axios.delete(`/blogposts/${id}`)
        .then(() => {
          setBlogs(blogs.filter(b => b.post_id !== id));
        })
        .catch(err => alert('Failed to delete'));
    }
  };

  const filteredBlogs = blogs.filter(b => 
    b.post_title.toLowerCase().includes(search.toLowerCase()) || 
    b.post_category.toLowerCase().includes(search.toLowerCase()) ||
    b.foodtype.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="admin-card">
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
        <h2>Blogpost Management</h2>
        <Link to="/admin/blogposts/create" className="admin-btn admin-btn-primary">+ New Blog Post</Link>
      </div>
      
      <div style={{ marginBottom: '20px' }}>
        <input 
          type="text" 
          placeholder="Search by title, category, or cuisine..." 
          style={{ width: '100%', padding: '12px', borderRadius: '5px', border: '1px solid #ccc' }}
          value={search}
          onChange={(e) => setSearch(e.target.value)}
        />
      </div>

      {isLoading ? (
        <div>Loading blog posts...</div>
      ) : (
        <div className="table-responsive">
          <table className="admin-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Cuisine</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {filteredBlogs.length > 0 ? filteredBlogs.map((blog, idx) => (
                <tr key={blog.post_id}>
                  <td>{idx + 1}</td>
                  <td>
                    <img src={blog.post_image ? blog.post_image.replace('../', '/') : ''} alt="Blog" style={{ width: '80px', height: '60px', objectFit: 'cover' }} onError={(e) => { (e.target as HTMLImageElement).src = 'https://placehold.co/80x60?text=No+Image'; }} />
                  </td>
                  <td>{blog.post_title}</td>
                  <td>{blog.post_category}</td>
                  <td>{blog.foodtype}</td>
                  <td>{new Date(blog.post_date).toLocaleDateString()}</td>
                  <td>
                    <div style={{ display: 'flex', gap: '8px', flexWrap: 'wrap' }}>
                      <Link to={`/admin/blogposts/edit/${blog.post_id}`} className="admin-btn admin-btn-primary">Edit</Link>
                      <button onClick={() => handleDelete(blog.post_id)} className="admin-btn admin-btn-danger">Delete</button>
                    </div>
                  </td>
                </tr>
              )) : (
                <tr><td colSpan={7} style={{ textAlign: 'center' }}>No blogposts found.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
