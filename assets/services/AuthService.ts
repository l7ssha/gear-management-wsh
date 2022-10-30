import axios from "axios"

export interface LoginResult {
    successful: boolean,
    errorMessage?: string|undefined
}

export default class AuthService {
    static async checkIfLoggedIn() {
        return localStorage.getItem('auth_user') !== null;
    }

    static async login(login: string, password: string): Promise<LoginResult> {
        try {
            const result = await axios.post("/api/auth/login", {
                login: login,
                password: password
            });

            localStorage.setItem('auth_user', result.data.token);

            return {
                successful: true
            };
        } catch (error) {
            return {
                successful: false,
                errorMessage: "Doesnt work"
            };
        }
    }
}
