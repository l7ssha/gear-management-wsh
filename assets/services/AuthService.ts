import jwtDecode, {JwtPayload} from "jwt-decode";
import axiosService from "./AxiosService";

interface JwtToken extends JwtPayload {
    username: string,
    email: string,
    id: string,
    roles: string[]
}

interface UserStorage {
    expiresAt: number,
    username: string,
    email: string
    id: string
    token: string,
    refreshToken: string
    roles: string[]
}

const USER_STORAGE_KEY = 'gmw-storage';

export interface LoginResult {
    successful: boolean,
    errorMessage?: string|undefined
}

export default class AuthService {
    static isLoggedIn() {
        return localStorage.getItem(USER_STORAGE_KEY) !== null;
    }

    static async refreshToken(): Promise<string|null>  {
        try {
            const userStorage = AuthService.getUserStorage();
            if (userStorage === null) {
                return null;
            }

            const result = await axiosService.post("/api/auth/refresh", {
                refreshToken: userStorage.refreshToken
            });

            const newUserStorage = AuthService.setUserStorageFromToken(result.data.token, result.data.refreshToken);
            return newUserStorage.token;
        } catch (error) {
            return null;
        }
    }

    static async login(login: string, password: string): Promise<LoginResult> {
        try {
            const result = await axiosService.post("/api/auth/login", {
                login: login,
                password: password
            });

            AuthService.setUserStorageFromToken(result.data.token, result.data.refreshToken);

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

    private static setUserStorageFromToken(token: string, refreshToken: string): UserStorage {
        const decodedToken = jwtDecode<JwtToken>(token);

        const userStorage: UserStorage = {
            expiresAt: decodedToken.exp,
            username: decodedToken.username,
            email: decodedToken.email,
            id: decodedToken.id,
            token: token,
            refreshToken: refreshToken,
            roles: decodedToken.roles
        };

        localStorage.setItem(USER_STORAGE_KEY, JSON.stringify(userStorage));

        return userStorage;
    }

    static getUserStorage(): UserStorage|null {
        const localStorageItem = localStorage.getItem(USER_STORAGE_KEY);

        return localStorageItem !== null
            ? JSON.parse(localStorageItem)
            : null;
    }
}
