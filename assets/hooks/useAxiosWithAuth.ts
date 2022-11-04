import {axiosWithAuth} from "../services/AxiosService";
import {useEffect} from "react";
import UseAuth from "./useAuth";
import useAuthRefresh from "./useAuthRefresh";

const useAxiosWithAuth = () => {
    const {token} = UseAuth();
    const {performRefresh} = useAuthRefresh();

    useEffect(() => {
        const requestIntercept = axiosWithAuth.interceptors.request.use(
            config => {
                config.headers['Authorization'] = `Bearer ${token()}`;

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
    }, [token, performRefresh]);

    return axiosWithAuth;
};

export default useAxiosWithAuth;
