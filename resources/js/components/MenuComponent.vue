<template>
    <b-navbar toggleable="lg" type="dark" variant="primary" v-if="esta_logado" >
            <b-navbar-brand href="#" :to="{ name: 'produtos' }">Faz-a-Feira</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item href="#" :to="{ name: 'produtos' }">Produtos</b-nav-item>
                    <b-nav-item href="#" :to="{ name: 'meus-produtos' }" >Meus Produtos</b-nav-item>
                </b-navbar-nav>

                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-item href="#" :to="{ name: 'favoritos' }">
                        <b-icon icon="suit-heart-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
                    </b-nav-item>
                    <b-nav-item href="#" :to="{ name: 'logout' }">Logout</b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
</template>

<script>
import store from '../store'
export default {    
  data() {
    return {
       esta_logado: store.state.isLoggedIn
    };
  },
};
</script>
