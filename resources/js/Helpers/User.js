import Token from './Token'
import AppStorage from './AppStorage'

class User{

    login(form){
        axios.post('api/login',form)
        .then(res => this.responseAfterLogin(res))
        .catch(error => console.log(error.response.data))
    }

    responseAfterLogin(res){

        const access_token = res.data.access_token
        const user = res.data.user.name

        if(Token.isValid(access_token)){
            AppStorage.store(user,access_token)
            window.location = '/'
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken();
        if(storedToken){
            return Token.isValid(storedToken) ? true : this.logout()
        }
        return false
    }

    loggedIn(){
        return this.hasToken()
    }

    logout(){
        AppStorage.clear()
        window.location = '/'
    }


    name(){
        if(this.loggedIn()){
            return AppStorage.getUser();
        }
    }

    id(){
        if(this.loggedIn()){
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub
        }
    }


    own(id){
        return this.id() == id;
    }

    // handle(error){
    //     if(error.response.data.error == 'Token is Expired' || 'Token is Invalid'){
    //         this.logout()
    //     }
    // }
}

export default User = new User()
