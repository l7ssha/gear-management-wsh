import AuthService from "../services/AuthService";
import {useNavigate} from "react-router";

const useAuth = () => {
    const navigate = useNavigate();

    return {
        getToken: () => {
            const userStorage = AuthService.getUserStorage();

            if (userStorage === null) {
                navigate('/login');
            }

            return userStorage.token;
        },
        performLogOut: () => {
            AuthService.logOut();
            navigate("/login");
        },
        loggedInUser: AuthService.getUserStorage()
    }
}

export default useAuth;
