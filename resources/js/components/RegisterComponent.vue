<template>
    <div class="text-center form-wrapper">
        <form class="form-signin" v-on:submit.prevent="submitRegister">
            <img class="mb-4" src="/images/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Cadastra-se aqui</h1>

            <label for="inputNome" class="sr-only">Nome</label>
            <input type="name" id="inputNome" class="form-control" placeholder="Nome" required autofocus v-model="name">

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus v-model="email">

            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="password">

            <label for="inputPassword" class="sr-only">Confirme a senha</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="confirma_senha">

            <b-navbar-nav class="ml-auto">
                <b-nav-item href="#" :to="{ name: 'login' }">Já sou cadastrado</b-nav-item>
            </b-navbar-nav>

            <button class="btn btn-lg btn-primary btn-block" style="margin-top:30px" type="submit">Cadastrar</button>
        </form>

    </div>
</template>

<script>
    import store from '../store'
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                confirma_senha: '',
                loginError: false,
            }
        },
        methods: {
            submitRegister() {
                this.loginError = false;
                axios.post('/api/auth/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    confirma_senha: this.confirma_senha,
                }).then(response => {                    
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