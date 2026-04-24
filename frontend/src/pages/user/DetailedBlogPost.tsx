import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import axios from 'axios';
import { useStylesheet } from '../../hooks/useStylesheet';

interface BlogPostType {
  post_id: number;
  post_title: string;
  post_category: string;
  foodtype: string;
  post_description: string;
  post_image: string;
  post_image2: string;
  post_date: string;
}

interface CommentType {
  comment_id: number;
  comment_text: string;
  created_at: string;
  user_name: string;
}

export default function DetailedBlogPost() {
  useStylesheet('/assets/user/css/DetailedBlogPost.css');
  const { id } = useParams<{ id: string }>();
  const [post, setPost] = useState<BlogPostType | null>(null);
  const [comments, setComments] = useState<CommentType[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  
  // Modal state
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [commentText, setCommentText] = useState('');
  const [rating, setRating] = useState<number>(5);

  // User auth state
  const [user, setUser] = useState<{user_id: number, user_name: string} | null>(null);

  useEffect(() => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      try { setUser(JSON.parse(storedUser)); } catch (e) {}
    }

    setIsLoading(true);
    // Fetch post and comments
    Promise.all([
      axios.get(`http://localhost:8000/api/blogposts/${id}`),
      axios.get(`http://localhost:8000/api/comments/${id}`)
    ])
    .then(([postRes, commentsRes]) => {
      setPost(postRes.data);
      setComments(commentsRes.data);
    })
    .catch(err => console.error(err))
    .finally(() => setIsLoading(false));
  }, [id]);

  const handleCommentSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!user) {
      alert("Please log in to leave a comment.");
      return;
    }
    if (!commentText.trim()) return;

    // We inject the rating into the comment text so it displays
    const finalCommentText = `[Rating: ${rating} Stars] ` + commentText;

    axios.post('http://localhost:8000/api/comments', {
      post_id: id,
      user_id: user.user_id,
      commenttext: finalCommentText
    })
    .then(res => {
      // Add the new comment to the state immediately
      const newComment = {
        comment_id: res.data.comment.comment_id,
        comment_text: finalCommentText,
        created_at: res.data.comment.created_at,
        user_name: user.user_name
      };
      setComments([newComment, ...comments]);
      setIsModalOpen(false);
      setCommentText('');
      setRating(5);
    })
    .catch(err => {
      console.error(err);
      alert("Error posting comment.");
    });
  };

  const handleDeleteComment = (commentId: number) => {
    if (!window.confirm("Are you sure you want to delete this comment?")) return;

    axios.delete(`http://localhost:8000/api/comments/${commentId}`)
      .then(() => {
        setComments(comments.filter(c => c.comment_id !== commentId));
      })
      .catch(err => console.error(err));
  };

  // Helper to extract rating from comment text if present
  const renderCommentText = (text: string) => {
    const ratingMatch = text.match(/^\[Rating: (\d) Stars\]/);
    if (ratingMatch) {
      const stars = parseInt(ratingMatch[1]);
      const cleanText = text.replace(/^\[Rating: \d Stars\]\s*/, '');
      return (
        <>
          <div style={{ color: '#FFD700', marginBottom: '5px', fontSize: '18px' }}>
            {'★'.repeat(stars)}{'☆'.repeat(5 - stars)}
          </div>
          {cleanText}
        </>
      );
    }
    return text;
  };

  // Calculate average rating
  const calculateAverageRating = () => {
    if (comments.length === 0) return 0;
    
    let totalStars = 0;
    let ratedCommentsCount = 0;

    comments.forEach(c => {
      const match = c.comment_text.match(/^\[Rating: (\d) Stars\]/);
      if (match) {
        totalStars += parseInt(match[1]);
        ratedCommentsCount++;
      }
    });

    if (ratedCommentsCount === 0) return 0;
    return totalStars / ratedCommentsCount;
  };

  const avgRating = calculateAverageRating();

  if (isLoading) {
    return (
      <div style={{ textAlign: 'center', padding: '100px', fontSize: '1.2rem', color: '#666' }}>
        <i className="fa-solid fa-spinner fa-spin" style={{ marginRight: '10px' }}></i>
        Loading blog post...
      </div>
    );
  }

  if (!post) {
    return <div style={{ textAlign: 'center', padding: '100px' }}>Post not found.</div>;
  }

  // Render a fractionally filled star display (or just nearest whole star for simplicity)
  const renderAverageStars = () => {
    if (avgRating === 0) return <span style={{ color: '#ccc', fontSize: '1.2rem' }}>No ratings yet</span>;
    
    const roundedRating = Math.round(avgRating);
    return (
      <>
        {'★'.repeat(roundedRating)}{'☆'.repeat(5 - roundedRating)}
        <span style={{ fontSize: '1rem', color: '#666', marginLeft: '8px', verticalAlign: 'middle' }}>
          ({avgRating.toFixed(1)})
        </span>
      </>
    );
  };

  return (
    <>
      <div className="blog-detail-wrapper">
        <div className="full-blog-container">
          <h1>{post.post_title}</h1>
          <div className="post-meta">
            <div className="post-date">
              <i className="far fa-calendar-alt"></i> 
              {new Date(post.post_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}
            </div>
            <div className="post-rating-display">
              {renderAverageStars()}
            </div>
          </div>
          
          <div className="post-content">
            <div className="post-img">
              {post.post_image && <img src={post.post_image} alt={post.post_title} />}
              {post.post_image2 && <img src={post.post_image2} alt={post.post_title + " 2"} />}
            </div>
            <div className="post-text">
              {post.post_description.split('\n').map((paragraph, idx) => (
                <p key={idx} style={{ marginBottom: '15px' }}>{paragraph}</p>
              ))}
            </div>
          </div>
          
          <div className="btn-display">
            <Link to="/blog" className="action-btn back-btn">
              <i className="fas fa-arrow-left"></i> Back to Blogs
            </Link>
            <button className="action-btn comment-btn" onClick={() => setIsModalOpen(true)}>
              <i className="far fa-comment-dots"></i> Add Comment & Rate
            </button>
          </div>

          <div className="comment-section">
            <h3>Community Reviews</h3>
            {comments.length > 0 ? (
              comments.map(comment => (
                <div className="comment" key={comment.comment_id}>
                  <div className="comment-header">
                    <h4><i className="fas fa-user-circle"></i> {comment.user_name}</h4>
                    <small>{new Date(comment.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</small>
                  </div>
                  <div className="comment-body">
                    <p>{renderCommentText(comment.comment_text)}</p>
                    {user && user.user_name === comment.user_name && (
                      <button 
                        className="deletebtn" 
                        onClick={() => handleDeleteComment(comment.comment_id)}
                      >
                        <i className="fas fa-trash-alt"></i>
                      </button>
                    )}
                  </div>
                </div>
              ))
            ) : (
              <p style={{ fontStyle: 'italic', color: '#888' }}>No reviews yet. Be the first to share your thoughts!</p>
            )}
          </div>
        </div>
      </div>

      {/* Comment & Rating Modal */}
      <div className={`popup ${isModalOpen ? 'active' : ''}`}>
        <div className="overlay" onClick={() => setIsModalOpen(false)}></div>
        <div className="popup-content">
          <form onSubmit={handleCommentSubmit}>
            <h2>Rate & Review</h2>
            
            <label>Your Rating</label>
            <div className="rating-input">
              {[5, 4, 3, 2, 1].map(num => (
                <React.Fragment key={num}>
                  <input 
                    type="radio" 
                    id={`star${num}`} 
                    name="rating" 
                    value={num} 
                    checked={rating === num}
                    onChange={() => setRating(num)}
                  />
                  <label htmlFor={`star${num}`}>★</label>
                </React.Fragment>
              ))}
            </div>

            <label htmlFor="review">Your Thoughts</label>
            <textarea 
              id="review" 
              placeholder="What did you think about this post?"
              value={commentText}
              onChange={(e) => setCommentText(e.target.value)}
              required
            ></textarea>

            <div className="popup-controls">
              <button type="button" className="close-btn" onClick={() => setIsModalOpen(false)}>Cancel</button>
              <button type="submit" className="submit-btn">Post Review</button>
            </div>
          </form>
        </div>
      </div>
    </>
  );
}
