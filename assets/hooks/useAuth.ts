import AuthService from "../services/AuthService";
import {useNavigate} from "react-router";

const useAuth = () => {
    const navigate = useNavigate();

    return {
        token: () => {
            const userStorage = AuthService.getUserStorage();

            if (userStorage === null) {
                navigate('/login');
            }

            return userStorage.token;
        }
    }
}

export default useAuth;
