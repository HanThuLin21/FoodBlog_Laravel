import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface BlogPostType {
  post_id: number;
  post_title: string;
  post_description: string;
  post_image: string;
  post_date: string;
}

import { useStylesheet } from '../../hooks/useStylesheet';

export default function BlogPost() {
  useStylesheet('/assets/user/css/BlogPost.css');
  const [posts, setPosts] = useState<BlogPostType[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [selectedPostId, setSelectedPostId] = useState<number | null>(null);

  useEffect(() => {
    setIsLoading(true);
    axios.get('http://localhost:8000/api/blogposts')
      .then(res => {
        setPosts(res.data);
        setIsLoading(false);
      })
      .catch(err => {
        console.error(err);
        setIsLoading(false);
      });
  }, []);

  const openPopup = (postId: number) => {
    setSelectedPostId(postId);
    setIsModalOpen(true);
  };

  const closePopup = () => {
    setIsModalOpen(false);
    setSelectedPostId(null);
  };

  const handleRatingSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const formData = new FormData(e.target as HTMLFormElement);
    const rating = formData.get('rating');
    if (!rating) {
      alert('Please select a rating.');
      return;
    }
    // Usually we would send this to the backend
    // axios.post('http://localhost:8000/api/ratings', { post_id: selectedPostId, rating })
    alert('Thank you for rating!');
    closePopup();
  };

  const filteredPosts = posts.filter(post => 
    post.post_title.toLowerCase().includes(searchTerm.toLowerCase()) || 
    post.post_description.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <>
      <main>
        <h1 className="page-title">Food Blog Collection</h1>
        <div className="search-container">
          <input 
            type="text" 
            id="search" 
            className="search-bar" 
            placeholder="Search blogs..." 
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
          />
        </div>
        
        <div className="blog-container">
          {isLoading ? (
            <div style={{ textAlign: 'center', padding: '50px', fontSize: '1.2rem', color: '#666' }}>
              <i className="fa-solid fa-spinner fa-spin" style={{ marginRight: '10px' }}></i>
              Loading delicious posts...
            </div>
          ) : filteredPosts.length > 0 ? (
            filteredPosts.map(post => (
              <div className="blog-card" key={post.post_id}>
                <img src={post.post_image} alt="Blog Image" className="blog-image" />
                <div className="blog-content">
                  <h2 className="blog-title">{post.post_title}</h2>
                  <p className="blog-date">Published on: {new Date(post.post_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}</p>
                  <p>{post.post_description.substring(0, 150)}...</p>
                  <div className="buttons">
                    <Link to={`/blog/${post.post_id}`} className="view-button">Read More</Link>
                    <button type="button" className="review-button" onClick={() => openPopup(post.post_id)}>Rate</button>
                  </div>
                </div>
              </div>
            ))
          ) : (
            <p style={{ textAlign: 'center', padding: '20px' }}>No posts found.</p>
          )}

          {/* Star Rating Modal */}
          {isModalOpen && (
            <div id="ratingModal" className="modal" style={{ display: 'block' }}>
              <div className="modal-content">
                <span className="close" onClick={closePopup}>&times;</span>
                <h2>Rate This Blog</h2>
                <form onSubmit={handleRatingSubmit}>
                  <input type="hidden" id="post_id" name="post_id" value={selectedPostId || ''} />
                  <div className="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" />
                    <label htmlFor="star5" title="5 stars">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label htmlFor="star4" title="4 stars">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label htmlFor="star3" title="3 stars">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label htmlFor="star2" title="2 stars">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label htmlFor="star1" title="1 star">&#9733;</label>
                  </div>
                  <button type="submit" name="submitRating" className="submit-btn">Submit Rating</button>
                </form>
              </div>
            </div>
          )}
        </div>
      </main>
    </>
  );
}
