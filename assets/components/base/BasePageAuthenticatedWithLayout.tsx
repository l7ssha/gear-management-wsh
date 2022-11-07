import { Container, Grid } from "@mui/material";
import * as React from "react";
import AppSidebar from "../AppSidebar";
import { Outlet } from "react-router";
import AppNavbar from "../AppNavbar";
import { useNavigate } from "react-router-dom";
import AuthService from "../../services/AuthService";
import { useEffect } from "react";

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

  return (
    <Container>
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
  );
}
