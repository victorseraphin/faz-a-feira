<template>
    <div class="text-center form-wrapper">
        <form class="form-signin" v-on:submit.prevent="submitLogin">
            <img class="mb-4" src="/images/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Por favor, identifique-se</h1>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus v-model="email">

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="password">
            
            <b-navbar-nav class="ml-auto">
                Novo por aqui? <b-nav-item href="#" :to="{ name: 'register' }">Crie sua conta</b-nav-item>
            </b-navbar-nav>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
        </form>

    </div>
</template>

<script>
    import store from '../store'
    export default {
        data() {
            return {
                email: '',
                password: '',
                loginError: false,
            }
        },
        methods: {
            submitLogin() {
                this.loginError = false;
                axios.post('/api/auth/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    // login user, store the token and redirect to dashboard
                    store.commit('loginUser')
                    store.state.dadosUser = JSON.stringify(response.data.user);
                    store.state.dadoToken = response.data.access_token;
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                    localStorage.setItem('token', response.data.access_token)
                    this.$router.push({ name: 'produtos' })
                }).catch(error => {
                    this.loginError = true
                });
            }
        }
    }
</script>

<style scoped>
    .form-wrapper {
        min-height: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>