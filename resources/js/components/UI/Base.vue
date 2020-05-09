<template>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <toolbar></toolbar>
        <div class="app-main">
            <div class="app-main__inner">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
import Toolbar from './Toolbar'
export default {
    components:{Toolbar},
    data(){
        return{
            loggedIn:User.loggedIn()
        }
    },
    created(){
        if(!this.loggedIn){
            this.$router.push('/login')
        }else{
            this.$router.push('/books')
        }
    }

}
</script>
