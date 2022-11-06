import {axiosWithAuth} from "../services/AxiosService";
import {useEffect} from "react";
import useAuth from "./useAuth";
import useAuthRefresh from "./useAuthRefresh";

const useAxiosWithAuth = () => {
    const {getToken, loggedInUser} = useAuth();
    const {performRefresh} = useAuthRefresh();

    useEffect(() => {
        const requestIntercept = axiosWithAuth.interceptors.request.use(
            async config => {
                let finalToken = getToken();

                const nowInMilis = new Date().getTime() / 1000;
                if (loggedInUser.expiresAt < nowInMilis) {
                    finalToken = await performRefresh();
                }

                config.headers['Authorization'] = `Bearer ${finalToken}`;

                return config;
            },
            (error) => Promise.reject(error)
        )

        const responseIntercept = axiosWithAuth.interceptors.response.use(
            config => config,
            async (error) => {
                const prevRequest = error?.config;

                if (error?.response?.status === 401 && !prevRequest?.sent) {
                    prevRequest.sent = true;
                    const newAccessToken = await performRefresh();
                    prevRequest.headers['Authorization'] = `Bearer ${newAccessToken}`;

                    return axiosWithAuth(prevRequest);
                }

                return Promise.reject(error);
            }
        );

        return () => {
            axiosWithAuth.interceptors.request.eject(requestIntercept);
            axiosWithAuth.interceptors.response.eject(responseIntercept);
        }
    }, [getToken, performRefresh]);

    return axiosWithAuth;
};

export default useAxiosWithAuth;
