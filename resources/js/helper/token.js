class Token {

    isValid(token) {
        const payload = this.payload(token)

        if (payload) {
            return payload.iss == "http://todos.live/api/auth/login"
            || "http://todos.live/api/auth/register" ? true : false;
        }

        return false;
    }

    payload(token) {
        const payload = token.split('.')[1];
        return this.decode(payload)
    }

    decode(token) {
        if (this.isBase64(token)) {
            return JSON.parse(atob(token))
        }

        return false;
    }

    isBase64(str) {
        try {
            return btoa(atob(str)) == str
        } catch (error) {
            return false
        }
    }

}

export default Token = new Token();
