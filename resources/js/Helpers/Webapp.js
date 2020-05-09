class Webapp{
    store(name){
        localStorage.setItem('app',name)
    }

    app(){
        return localStorage.getItem('app')
    }

    headerClass(){
        if(this.app() == 'Single Page Forum'){
            return 'app-header header-shadow'
        }else if(this.app() == 'Cloud Travel'){
            return 'app-header header-shadow bg-premium-dark header-text-light'
        }else{
            return 'app-header header-shadow bg-royal header-text-light'
        }
    }
    sidebarClass(){
        if(this.app() == 'Single Page Forum'){
            return 'app-sidebar sidebar-shadow'
        }else if(this.app() == 'Cloud Travel'){
            return 'app-sidebar sidebar-shadow bg-premium-dark sidebar-text-light'
        }else{
            return 'app-sidebar sidebar-shadow bg-royal sidebar-text-light'
        }
    }
}
export default Webapp = new Webapp()
