<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-shadow-info border mb-3 card card-body border-info col-md-12">
                <div class="card-header text-center">
                    <form @submit.prevent= storeBook>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" required v-model="form.name" placeholder="Enter Book Name.." class="form-control" id="">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success btn-md form-control" type="submit">Save</button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-bodered">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="book in books" :key="book.id">
                                <td>{{book.name}}</td>
                                <td>{{book.at}}</td>
                                <td >
                                    <button v-if="!book.trashed" type="button" class="btn btn-sm btn-warning" @click="destroyTemp(book.id)">Temporarily</button>
                                    <button v-if="!book.trashed" type="button" class="btn btn-sm btn-danger" @click="destroyPerm(book.id)">Permanently</button>
                                    <button v-if="book.trashed" type="button" class="btn btn-sm btn-success" @click="restore(book.id)">Restore</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                name:null
            },
            books:null
        }
    },
    created(){
        this.fetchBooks()
    },
    methods:{
        fetchBooks(){
            axios.get('/api/books')
            .then(res => this.books = res.data.data)
            .catch(error => console.log(error))
        },
        storeBook(){
            axios.post('api/books',this.form)
            .then(res => {
                this.fetchBooks()
                this.form.name = null
                })
            .catch(error => console.log(error))

        },
        destroyTemp(foo){
            axios.delete(`/api/books/${foo}`)
            .then(res => this.fetchBooks())
            .catch(error => console.log(error))
        },
        destroyPerm(foo){
            axios.delete(`/api/books/destroyPermanently/${foo}`)
            .then(res => this.fetchBooks())
            .catch(error => console.log(error))
        },
        restore(foo){
            axios.get(`/api/books/restore/${foo}`)
            .then(res => this.fetchBooks())
            .catch(error => console.log(error))
        }
    }
}
</script>
