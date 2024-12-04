<template>
    <nav class="navbar">
      <div class="navbar-container">
        <div class="logo">
          <h1>Customer Address Book</h1>
        </div>
        <ul class="navbar-links">
          <li>
            <router-link to="/" class="nav-link">Home</router-link>
          </li>
          <li>
            <router-link to="/add-customer" class="nav-link">Add Customer</router-link>
          </li>
          <li>
            <router-link to="/search" class="nav-link">Search Customer</router-link>
          </li>
          <li v-if="isAuthenticated">
            <button @click="handleLogout" class="logout-btn">Logout</button>
          </li>
          <li v-else>
            <router-link to="/login" class="login-link">Login</router-link>
            <router-link to="/signup" class="login-link">SignUp</router-link>
          </li>
        </ul>
      </div>
    </nav>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import { logout } from '../apiService';
  
  export default {
    name: 'Navbar',
    setup() {
      const router = useRouter();
      const isAuthenticated = ref(localStorage.getItem('token') !== null);
  
      const handleLogout = async () => {
        try {
          await logout();
          localStorage.removeItem('token'); 
          isAuthenticated.value = false; 
          router.push('/login'); 
        } catch (error) {
          console.error('Error during logout:', error);
          alert('Logout failed');
        }
      };
  
      onMounted(() => {
        isAuthenticated.value = localStorage.getItem('token') !== null;
      });
  
      return {
        isAuthenticated,
        handleLogout,
      };
    },
  };
  </script>
  
  <style scoped>
  .navbar {
  background-color: #343a40;
  padding: 15px 0;
  color: white;
  font-family: 'Arial', sans-serif;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 98.9vw; 
  z-index: 1000;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px; 
}
  
  .logo h1 {
    margin: 0;
    color: #fff;
    font-size: 24px;
    font-weight: 700;
    text-transform: uppercase;
  }
  
  .navbar-links {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
  }
  
  .navbar-links li {
    margin-left: 20px;
  }
  
  .nav-link {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: color 0.3s;
  }
  
  .nav-link:hover {
    color: #007bff;
    text-decoration: underline;
  }
  
  
  .logout-btn,
  .login-link {
    font-size: 16px;
    font-weight: 500;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    transition: all 0.3s;
    margin-left:5px;
  }
  
  .logout-btn {
    background-color: #e74c3c;
    border: none;
    cursor: pointer;
  }
  
  .logout-btn:hover {
    background-color: #c0392b;
  }
  
  .login-link {
    background-color: #007bff;
    text-decoration: none;
    display: inline-block;
  }
  
  .login-link:hover {
    background-color: #0056b3;
  }

  .signup-text {
  margin-top: 20px;
  font-size: 14px;
  color: #555;
}

.signup-link {
  color: #007bff;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease;
}

.signup-link:hover {
  color: #0056b3;
}
  
  @media (max-width: 768px) {
    .navbar-container {
      flex-direction: column;
      align-items: center;
    }
    .navbar-links {
      flex-direction: column;
      margin-top: 10px;
    }
    .navbar-links li {
      margin-left: 0;
      margin-top: 10px;
    }
  }
  </style>
  