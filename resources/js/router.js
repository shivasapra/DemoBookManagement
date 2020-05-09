import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Login from './components/Auth/Login'
import Register from './components/Auth/Register'
import Books from './components/Books'

const routes = [
  { path: '/login', component: Login , name:'Login' },
  { path: '/register', component: Register , name:'Register' },
  { path: '/books', component: Books , name:'Books' },
]



const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
  })

export default router
