import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Shop from  "../components/products/container"
import Cart from  "../components/products/cart"
import Products from  "../components/products/list"
import ProductView from  "../components/products/view"
import Users from  "../components/users/list"
import UsersCreate from  "../components/users/create"
import Login from  "../components/login/container"

const routes = [
    {
        component: Shop,
        name: "shop",
        path: "/shop"
    },
    {
        component: Users,
        name: "users",
        path: "/users"
    },
    {
        component: UsersCreate,
        name: "usersCreate",
        path: "/users/create"
    },
    {
        component: Login,
        name: "login",
        path: "/login"
    },
    {
        component: Products,
        name: "products",
        path: "/products"
    },
    {
        component: ProductView,
        name: "product",
        path: "/products/:slug"
    },
    {
        component: Cart,
        name: "cart",
        path: "/cart"
    },
];

export default new VueRouter({
    routes, // short for routes: routes
    mode: 'history'
})