class Token {

    isValid(token) {
        const payload = this.payload(token)

        if (payload) {
            return payload.iss == "http://todos.live/api/auth/login" ? true : false;
        }

        return false;
    }

    payload(token) {
        const payload = token.split('.')[1];
        // console.log(token)
        return this.decode(payload)
    }

    decode(token) {
        return JSON.parse(atob(token))
    }

}

export default Token = new Token();
