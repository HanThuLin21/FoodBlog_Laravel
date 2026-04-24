import React from 'react';
import { useStylesheet } from '../../hooks/useStylesheet';

export default function About() {
  useStylesheet('/assets/user/css/About.css');

  return (
    <main className="creative-about-page">
      {/* Creative Hero Section */}
      <section className="creative-hero">
        <div className="hero-background" style={{ backgroundImage: "url('/assets/images/about-hero.png')" }}></div>
        <div className="hero-content-box">
          <span className="subtitle">Welcome To</span>
          <h1>Delicious Bites</h1>
          <div className="hero-divider"></div>
          <p>Sharing our love for food, authentic recipes, and culinary adventures with the world.</p>
        </div>
      </section>

      {/* Overlapping Story Section */}
      <section className="creative-story">
        <div className="story-container">
          <div className="story-image-stack">
            <img src="/assets/images/cooking-together.png" alt="Cooking together" className="main-image" />
            <div className="floating-badge">
              <i className="fa-solid fa-heart"></i>
              <span>100% Passion</span>
            </div>
          </div>
          <div className="story-text-card">
            <h2>Our Story</h2>
            <p className="lead-text">Founded in 2023, our mission is to celebrate the joy of cooking and eating.</p>
            <p>Whether you're a seasoned chef or a home cook, we’re here to inspire your culinary journey with mouthwatering recipes, restaurant reviews, and food-related stories. From quick weekday meals to elaborate weekend feasts, we’ve got you covered.</p>
            <p>We believe that food is more than just sustenance—it’s a way to connect, create memories, and explore cultures. Join us as we share our passion for food!</p>
          </div>
        </div>
      </section>

      {/* Creative Team Section */}
      <section className="creative-team">
        <div className="team-header">
          <h2>Meet Our Expert Team</h2>
          <p>The faces behind your favorite recipes and reviews.</p>
        </div>
        <div className="creative-team-grid">
          <div className="creative-team-card">
            <div className="card-img-wrapper">
              <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=400&auto=format&fit=crop" alt="John Doe" />
            </div>
            <div className="card-info">
              <h3>John Doe</h3>
              <span>Founder & Head Chef</span>
            </div>
          </div>
          <div className="creative-team-card">
            <div className="card-img-wrapper">
              <img src="/assets/images/han-thu-lin.jpg" alt="Han Thu Lin" />
            </div>
            <div className="card-info">
              <h3>Han Thu Lin</h3>
              <span>Web Developer</span>
            </div>
          </div>
          <div className="creative-team-card">
            <div className="card-img-wrapper">
              <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop" alt="Emily Brown" />
            </div>
            <div className="card-info">
              <h3>Emily Brown</h3>
              <span>Restaurant Critic</span>
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
