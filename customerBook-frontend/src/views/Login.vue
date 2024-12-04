<template>
  <div class="login-container">
    <h2>Login</h2>
    <form @submit.prevent="handleLogin" class="login-form">
      <div class="form-group">
        <label for="email">Email:</label>
        <input id="email" v-model="email" type="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" v-model="password" type="password" required />
      </div>
      <button type="submit" class="login-button">Login</button>
    </form>
    <p class="signup-text">
      Don't have an account?
      <router-link to="/signup" class="signup-link">Sign Up</router-link>
    </p>
  </div>
</template>

<script>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { login } from '../apiService'

export default {
  setup() {
    const email = ref('')
    const password = ref('')
    const router = useRouter()

    const handleLogin = async () => {
      try {
        const response = await login({ email: email.value, password: password.value })
        const token = response.data.token

        localStorage.setItem('token', token)
        router.push('/').then(() => {
          window.location.reload()
        })
      } catch (error) {
        console.error('Login failed:', error)
        alert('Invalid credentials')
      }
    }

    return {
      email,
      password,
      handleLogin,
    }
  },
}
</script>

<style scoped>
.login-container {
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

.login-form {
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

.login-button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-button:hover {
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

@media (max-width: 500px) {
  .login-container {
    padding: 15px;
  }
  input {
    font-size: 14px;
  }
  .login-button {
    font-size: 14px;
  }
}
</style>
