import * as React from "react";
import { useLoaderData } from "react-router";
import { useEffect, useState } from "react";
import useApi, { Camera } from "../../hooks/useApi";
import { Box } from "@mui/material";

export default function CameraDetails() {
  const cameraId = useLoaderData();
  const [cameraDetails, setCameraDetails] = useState<Camera | null>(null);
  const { fetchCamera } = useApi();

  useEffect(() => {
    fetchCamera(cameraId.toString()).then((camera) => setCameraDetails(camera));
  }, []);

  return <Box component="div">{cameraDetails?.model}</Box>;
}
