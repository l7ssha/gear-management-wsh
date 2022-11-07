import { Box, Card, CardContent, Container, Grid, Typography } from "@mui/material";
import BasicLoader from "./loading/BasicLoader";
import * as React from "react";
import useAuth from "../hooks/useAuth";
import { useEffect, useState } from "react";
import useApi, { UserStats } from "../hooks/useApi";

export default function AppSidebar() {
  const { loggedInUser } = useAuth();
  const { fetchUserStats } = useApi();
  const [userStats, setUserStats] = useState<UserStats | null>(null);

  useEffect(() => {
    fetchUserStats().then((stats) => {
      setUserStats(stats);
    });
  }, []);

  return (
    <Box>
      <Grid container direction="column" alignItems="stretch" spacing={1}>
        <Grid item>
          <Card variant="outlined">
            <CardContent>Hi, {loggedInUser.username}</CardContent>
          </Card>
        </Grid>

        <Grid item>
          <Card variant="outlined">
            <CardContent>
              <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom variant="h5">
                <Box component="span">Cameras&nbsp;</Box>
                <Box component="span" sx={{ fontWeight: 700 }}>
                  <BasicLoader loading={userStats === null}>
                    <span>{userStats?.cameraCount}</span>
                  </BasicLoader>
                </Box>
              </Typography>

              <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom variant="h5">
                <Box component="span">Lens&nbsp;</Box>
                <Box component="span" sx={{ fontWeight: 700 }}>
                  <BasicLoader loading={userStats === null}>
                    <span>{userStats?.lensCount}</span>
                  </BasicLoader>
                </Box>
              </Typography>
            </CardContent>
          </Card>
        </Grid>
      </Grid>
    </Box>
  );
}
