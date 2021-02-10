import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import LoginComponent from './components/LoginComponent'
import LogoutComponent from './components/LogoutComponent'
import RegisterComponent from './components/RegisterComponent'
import ProdutosComponent from './components/ProdutosComponent'
import ProdutosDetalhesComponent from './components/ProdutosDetalhesComponent'
import MeusProdutosComponent from './components/MeusProdutosComponent'
import FavoritosComponent from './components/FavoritosComponent'
import NotFound from './components/NotFound'
import store from './store'

const routes = [{
        path: '/',
        name: 'index',
        component: ProdutosComponent,
        meta: { requiresAuth: true }
    },
    {
        path: '/produtos',
        name: 'produtos',
        component: ProdutosComponent,
        meta: { requiresAuth: true }
    },
    {
        path: '/produtos-detalhes/:id',
        name: 'produtos-detalhes',
        component: ProdutosDetalhesComponent,
        meta: { requiresAuth: true }
    },
    {
        path: '/meus-produtos',
        name: 'meus-produtos',
        component: MeusProdutosComponent,
        meta: { requiresAuth: true }
    },
    {
        path: '/favoritos',
        name: 'favoritos',
        component: FavoritosComponent,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/logout',
        name: 'logout',
        component: LogoutComponent
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterComponent
    },
    {
        path: '*',
        name: 'not-found',
        component: NotFound
    }
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }
    // if logged in redirect to dashboard
    if (to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'produtos' })
        return
    }

    next()
});

export default router