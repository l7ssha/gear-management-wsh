import { Container, createTheme, Grid, ThemeProvider } from "@mui/material";
import * as React from "react";
import AppSidebar from "../AppSidebar";
import { Outlet } from "react-router";
import AppNavbar from "../AppNavbar";
import { useNavigate } from "react-router-dom";
import AuthService from "../../services/AuthService";
import { useEffect } from "react";
import CssBaseline from "@mui/material/CssBaseline";

export const ColorModeContext = React.createContext({ toggleColorMode: () => {} });

export default function BasePageAuthenticatedWithLayout() {
  const navigate = useNavigate();

  const loggedIn = AuthService.isLoggedIn();
  useEffect(() => {
    if (!loggedIn) {
      navigate("/login");
    }
  });

  if (!loggedIn) {
    return <></>;
  }

  const [mode, setMode] = React.useState<"light" | "dark">("light");
  const colorMode = React.useMemo(
    () => ({
      toggleColorMode: () => {
        setMode((prevMode) => (prevMode === "light" ? "dark" : "light"));
      },
    }),
    []
  );

  const theme = React.useMemo(
    () =>
      createTheme({
        palette: {
          mode,
        },
      }),
    [mode]
  );

  return (
    <ColorModeContext.Provider value={colorMode}>
      <ThemeProvider theme={theme}>
        <CssBaseline />
        <Container sx={{ backgroundColor: "background.default", color: "text.primary", height: "100%" }}>
          <AppNavbar />
          <Container sx={{ mt: 10, paddingBottom: 2 }}>
            <Grid container spacing={3} alignItems="stretch">
              <Grid item md={2}>
                <AppSidebar />
              </Grid>

              <Grid item md={10}>
                <Outlet />
              </Grid>
            </Grid>
          </Container>
        </Container>
      </ThemeProvider>
    </ColorModeContext.Provider>
  );
}
