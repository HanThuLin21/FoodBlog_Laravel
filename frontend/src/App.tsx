import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import UserLayout from './layouts/UserLayout';
import AdminLayout from './layouts/AdminLayout';

// User Pages
import Home from './pages/user/Home';
import BlogPost from './pages/user/BlogPost';
import DetailedBlogPost from './pages/user/DetailedBlogPost';
import Recipe from './pages/user/Recipe';
import ViewRecipe from './pages/user/ViewRecipe';
import Restaurant from './pages/user/Restaurant';
import SeeViewRestaurant from './pages/user/SeeViewRestaurant';
import About from './pages/user/About';
import UserLogin from './pages/user/UserLogin';
import UserRegister from './pages/user/UserRegister';

// Admin Pages
import AdminLogin from './pages/admin/AdminLogin';
import AdminRegister from './pages/admin/AdminRegister';
import Dashboard from './pages/admin/Dashboard';
import BlogList from './pages/admin/BlogPosts/BlogList';
import BlogForm from './pages/admin/BlogPosts/BlogForm';
import RecipeList from './pages/admin/Recipes/RecipeList';
import RecipeForm from './pages/admin/Recipes/RecipeForm';
import RestaurantList from './pages/admin/Restaurants/RestaurantList';
import RestaurantForm from './pages/admin/Restaurants/RestaurantForm';
import UserMgmt from './pages/admin/UserMgmt';

function App() {
  return (
    <Router>
      <Routes>
        {/* User Auth */}
        <Route path="/login" element={<UserLogin />} />
        <Route path="/register" element={<UserRegister />} />
        
        {/* Admin Auth */}
        <Route path="/admin/login" element={<AdminLogin />} />
        <Route path="/admin/register" element={<AdminRegister />} />
        
        <Route path="/blog/:id" element={<DetailedBlogPost />} />
        
        <Route path="/" element={<UserLayout />}>
          <Route index element={<Home />} />
          <Route path="blog" element={<BlogPost />} />
          <Route path="recipes" element={<Recipe />} />
          <Route path="recipes/:id" element={<ViewRecipe />} />
          <Route path="restaurants" element={<Restaurant />} />
          <Route path="restaurants/:id" element={<SeeViewRestaurant />} />
          <Route path="about" element={<About />} />
        </Route>

        {/* Admin Dashboard & CRUD */}
        <Route path="/admin" element={<AdminLayout />}>
          <Route index element={<Dashboard />} />
          <Route path="dashboard" element={<Dashboard />} />
          
          <Route path="blogposts" element={<BlogList />} />
          <Route path="blogposts/create" element={<BlogForm />} />
          <Route path="blogposts/edit/:id" element={<BlogForm />} />

          <Route path="recipes" element={<RecipeList />} />
          <Route path="recipes/create" element={<RecipeForm />} />
          <Route path="recipes/edit/:id" element={<RecipeForm />} />

          <Route path="restaurants" element={<RestaurantList />} />
          <Route path="restaurants/create" element={<RestaurantForm />} />
          <Route path="restaurants/edit/:id" element={<RestaurantForm />} />

          <Route path="users" element={<UserMgmt />} />
        </Route>
      </Routes>
    </Router>
  );
}

export default App;
