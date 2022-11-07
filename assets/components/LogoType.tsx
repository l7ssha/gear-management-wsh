import CameraIcon from "@mui/icons-material/Camera";
import Typography from "@mui/material/Typography";
import * as React from "react";
import { Box } from "@mui/material";

export default function LogoType() {
  return (
    <Box
      justifyContent="center"
      textAlign="center"
      sx={{ verticalAlign: "middle", display: "inline-flex", color: "white" }}
    >
      <CameraIcon sx={{ mr: 2 }} />
      <Typography sx={{ fontWeight: 700 }} component="span">
        Gear Manager
      </Typography>
    </Box>
  );
}
