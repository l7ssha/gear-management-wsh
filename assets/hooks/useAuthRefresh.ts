import AuthService from "../services/AuthService";
import {useNavigate} from "react-router";

const useAuth = () => {
    const navigate = useNavigate();

    return {
        performRefresh: async (): Promise<string> => {
            const refreshedToken = AuthService.refreshToken();

            if (refreshedToken === null) {
                navigate('/login');
            }

            return refreshedToken;
        }
    }
}

export default useAuth;
