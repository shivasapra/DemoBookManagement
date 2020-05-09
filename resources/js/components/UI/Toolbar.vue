<template>
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <h4>Book Management</h4>
        </div>
        <div class="app-header__content">
            <div class="app-header-left"></div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                            </div>

                                <div class="widget-content-left  ml-3 header-user-info" v-if="loggedIn">
                                    <div class="widget-heading">
                                        {{name}}
                                    </div>
                                </div>

                            <div class="widget-content-right header-user-info ml-3">
                                <span v-if="loggedIn">
                                    <button type="button" class="btn-shadow p-1 btn btn-danger btn-sm" @click="logout">
                                        Logout
                                    </button>
                                </span>
                                <span v-else>
                                    <button type="button" class=" btn btn-primary btn-sm" @click="login">Login</button>
                                    <button type="button" class=" btn btn-primary btn-sm" @click="register">Register</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            loggedIn:User.loggedIn(),
            name:User.name()
        }
    },
    methods:{
        login(){
            this.$router.push('/login')
        },
        register(){
            this.$router.push('/register')
        },
        logout(){
            User.logout()
        }
    }
}
</script>
