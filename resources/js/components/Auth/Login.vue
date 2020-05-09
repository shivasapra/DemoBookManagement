<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-shadow-success border mb-3 card card-body border-success col-md-12">

                <div class="card-header">Login &nbsp;
                     <span class="text-danger" v-if="error">
                        ({{error}})
                    </span>
                </div>

                <div class="card-body">
                    <form @submit.prevent= login>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" v-model="form.email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="form.password" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
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
            form:{
                email:null,
                password:null
            },
            error:null
        }
    },
    methods:{
        login(){
            this.error = null
            axios.post('api/login',this.form)
            .then(res => User.responseAfterLogin(res))
            .catch(error => this.error = error.response.data)
        }
    }
}
</script>
