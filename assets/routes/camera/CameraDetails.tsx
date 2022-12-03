import * as React from "react";
import { useLoaderData } from "react-router";
import { useEffect, useState } from "react";
import useApi, { Camera, cameraTypeOptions} from "../../hooks/useApi";
import {
  Box,
  Card,
  CardContent,
  FormControl,
  Grid,
  InputLabel,
  MenuItem,
  Select,
  TextField,
  Typography
} from "@mui/material";
import EditableForm from "../../components/form/EditableForm";
import { useForm } from "react-hook-form";

export default function CameraDetails() {
  const cameraId = useLoaderData();
  const { register } = useForm();
  const [cameraDetails, setCameraDetails] = useState<Camera | null>(null);
  const { fetchCamera } = useApi();

  useEffect(() => {
    fetchCamera(cameraId.toString()).then((camera) => setCameraDetails(camera));
  }, []);

  const titleElement = (
    <Typography variant="h4">
      {cameraDetails?.producer.name} {cameraDetails?.model}
    </Typography>
  );

  return (
    <Card variant="outlined">
      <CardContent>
        <EditableForm editable={false} handleSubmit={(data: any) => console.log(data)} titleElement={titleElement}>
          <Grid container spacing={2} direction="row">
            <Grid item>
              <FormControl fullWidth>
                <TextField type="text" value={cameraDetails?.model || ""} label="Camera Model" {...register('camera-model')}/>
              </FormControl>
            </Grid>
            <Grid item>
              <FormControl fullWidth>
                <InputLabel id="camera-type-label">Camera Type</InputLabel>
                <Select
                    labelId='camera-type-id'
                    label='Camera Type'
                    value={cameraDetails?.type || ""}
                    {...register('camera-type')}
                >
                  {
                    cameraTypeOptions.map(cameraType => {
                      return <MenuItem key={cameraType} value={cameraType}>{cameraType}</MenuItem>
                    })
                  }
                </Select>
              </FormControl>
            </Grid>
          </Grid>
        </EditableForm>
      </CardContent>
    </Card>
  );
}
