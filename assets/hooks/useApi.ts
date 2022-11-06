import useAxiosWithAuth from "./useAxiosWithAuth";

export interface UserStats {
    cameraCount: number,
    lensCount: number
}

export default function useApi() {
    const axiosPrivate = useAxiosWithAuth();

    return {
        fetchUserStats: async (): Promise<UserStats> => {
            const response = await axiosPrivate.get<UserStats>("/api/users/stats");
            return response.data;
        }
    };
}
