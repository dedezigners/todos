import User from './user'

class Exception {
    handler(error) {
        this.isExpired(error.response.data.code)
    }

    isExpired(error) {
        if (error == 401) {
            User.logout()
        }
    }
}

export default Exception = new Exception();