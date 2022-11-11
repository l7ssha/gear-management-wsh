import { Box, IconButton, Theme, Tooltip } from "@mui/material";
import * as React from "react";
import DarkModeIcon from "@mui/icons-material/DarkMode";
import LightModeIcon from "@mui/icons-material/LightMode";
import { ColorModeContext } from "../base/BasePageAuthenticatedWithLayout";
import { useTheme } from "@mui/material/styles";

export default function ThemeSwitch() {
  const colorMode = React.useContext(ColorModeContext);
  const theme: Theme = useTheme();

  const onClickAction = () => {
    colorMode.toggleColorMode();
  };

  const innerIcon = theme.palette.mode === "dark" ? <DarkModeIcon /> : <LightModeIcon />;

  const tooltipText = theme.palette.mode === "dark" ? "Change theme to light" : "Change theme to dark";

  return (
    <Tooltip title={tooltipText} sx={{ pr: 2 }}>
      <Box component="span">
        <IconButton sx={{ p: 0, color: "white" }} onClick={onClickAction} size="large">
          {innerIcon}
        </IconButton>
      </Box>
    </Tooltip>
  );
}
