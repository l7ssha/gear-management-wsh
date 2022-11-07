import useAxiosWithAuth from "./useAxiosWithAuth";

export interface UserStats {
  cameraCount: number;
  lensCount: number;
}

export interface Camera {
  id: string;
  producer: PartialProducer;
  model: string;
  format: string;
  system: PartialSystem;
  serialNumber: string;
  serialNumberAlternative: string | null;
}

export interface PartialProducer {
  name: string;
}

export interface PartialSystem {
  name: string;
}

export default function useApi() {
  const axiosPrivate = useAxiosWithAuth();

  return {
    fetchUserStats: async (): Promise<UserStats> => {
      const response = await axiosPrivate.get<UserStats>("/api/users/stats");
      return response.data;
    },
    fetchCameras: async (params: object | URLSearchParams | null = null): Promise<Camera[]> => {
      const response = await axiosPrivate.get<Camera[]>("/api/cameras", {
        params: params,
      });
      return response.data;
    },
    fetchCamera: async (cameraId: string): Promise<Camera> => {
      const response = await axiosPrivate.get<Camera>(`/api/cameras/${cameraId}`);
      return response.data;
    },
  };
}
