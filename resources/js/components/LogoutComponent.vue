<template>

</template>

<script>
    import store from '../store'
    export default {
        mounted () {
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            store.commit('logoutUser')
            store.state.dadosUser = null;
            store.state.dadoToken = null;
            this.$router.push({ name: 'login' })
        }
    }
</script>