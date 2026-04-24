import React, { useEffect, useState } from 'react';
import axios from 'axios';

interface User {
  user_id: number;
  user_name: string;
  user_email: string;
  user_phone: string;
}

export default function UserMgmt() {
  const [users, setUsers] = useState<User[]>([]);
  const [search, setSearch] = useState('');
  const [isLoading, setIsLoading] = useState(true);

  const fetchUsers = () => {
    setIsLoading(true);
    axios.get('http://localhost:8000/api/users')
      .then(res => setUsers(res.data))
      .catch(err => console.error(err))
      .finally(() => setIsLoading(false));
  };

  useEffect(() => {
    fetchUsers();
  }, []);

  const handleDelete = (id: number) => {
    if (window.confirm("Are you sure you want to remove this user?")) {
      axios.delete(`http://localhost:8000/api/users/${id}`)
        .then(() => {
          setUsers(users.filter(u => u.user_id !== id));
        })
        .catch(err => alert('Failed to remove user'));
    }
  };

  const filteredUsers = users.filter(u => 
    u.user_name.toLowerCase().includes(search.toLowerCase()) || 
    u.user_email.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="admin-card">
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
        <h2>User Management</h2>
      </div>
      
      <div style={{ marginBottom: '20px' }}>
        <input 
          type="text" 
          placeholder="Search by name or email..." 
          style={{ width: '100%', padding: '12px', borderRadius: '5px', border: '1px solid #ccc' }}
          value={search}
          onChange={(e) => setSearch(e.target.value)}
        />
      </div>

      {isLoading ? (
        <div>Loading users...</div>
      ) : (
        <div className="table-responsive">
          <table className="admin-table">
            <thead>
              <tr>
                <th>No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {filteredUsers.length > 0 ? filteredUsers.map((user, idx) => (
                <tr key={user.user_id}>
                  <td>{idx + 1}</td>
                  <td>{user.user_name}</td>
                  <td>{user.user_email}</td>
                  <td>{user.user_phone}</td>
                  <td>
                    <button onClick={() => handleDelete(user.user_id)} className="admin-btn admin-btn-danger">Remove</button>
                  </td>
                </tr>
              )) : (
                <tr><td colSpan={5} style={{ textAlign: 'center' }}>No users found.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
