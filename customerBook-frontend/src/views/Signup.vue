<template>
    <div class="signup-container">
      <h2>Sign Up</h2>
      <form @submit.prevent="handleSignUp" class="signup-form">
        <div class="form-group">
          <label for="name">Name:</label>
          <input id="name" v-model="name" type="text" required />
        </div>
  
        <div class="form-group">
          <label for="email">Email:</label>
          <input id="email" v-model="email" type="email" required />
        </div>
  
        <div class="form-group">
          <label for="password">Password:</label>
          <input id="password" v-model="password" type="password" required />
        </div>
  
        <button type="submit" class="signup-button">Sign Up</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  import { signup } from '../apiService' 
  
  export default {
    setup() {
      const name = ref('')
      const email = ref('')
      const password = ref('')
      const router = useRouter()
  
      const handleSignUp = async () => {
        try {
          await signup({ name: name.value, email: email.value, password: password.value })
          alert('Sign-up successful! Please login.')
          router.push('/login') 
        } catch (error) {
          console.error('Sign-up failed:', error)
          alert('Sign-up failed. Please try again.')
        }
      }
  
      return {
        name,
        email,
        password,
        handleSignUp,
      }
    },
  }
  </script>
  
  <style scoped>
  .signup-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
  }
  
  h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
  }
  
  .signup-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
  
  .form-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  
  label {
    font-size: 14px;
    margin-bottom: 5px;
    color: #555;
  }
  
  input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    transition: border 0.3s ease;
  }
  
  input:focus {
    border-color: #007bff;
  }
  
  .signup-button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .signup-button:hover {
    background-color: #0056b3;
  }
  
  @media (max-width: 500px) {
    .signup-container {
      padding: 15px;
    }
    input {
      font-size: 14px;
    }
    .signup-button {
      font-size: 14px;
    }
  }
  </style>
  