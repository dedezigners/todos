import Token from './token'
import Storage from './storage'

class User {

    login(data) {
        axios.post('/api/auth/login', data)
        .then(res => this.responseAfterLogin(res))
        .catch(error => console.log(error.response.data))
    }

    responseAfterLogin(res) {
        const access_token = res.data.access_token
        const user = res.data.user
        
        if (Token.isValid(access_token)) {
            console.log("User and Token stored")
            Storage.store(user, access_token)
        }

        window.location = '/forum'
    }

    hasToken() {
        const storedToken = Storage.getToken()
        
        if (storedToken) {
            return Token.isValid(storedToken) ? true : false
        }

        return false
    }

    loggedIn() {
        return this.hasToken()
    }

    logout() {
        Storage.clear()
        window.location = '/forum'
    }

    name() {
        if (this.loggedIn()) {
            return Storage.getUser()
        }
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(Storage.getToken())
            return payload.sub
        }
    }

    isOwner(id) {
        return this.id() === id
    }

}

export default User = new User();
