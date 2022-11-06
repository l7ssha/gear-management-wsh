import * as React from "react";
import {Box, Card, CardContent, Grid, Typography} from "@mui/material";;
import useApi from "../hooks/useApi";
import {UserStats} from "../hooks/useApi";
import {useEffect, useState} from "react";
import BasePage from "../components/base/BasePage";
import useAuth from "../hooks/useAuth";

export default function Root() {
    const {fetchUserStats} = useApi();
    const [userStats, setUserStats] = useState<UserStats|null>(null);
    const {loggedInUser} = useAuth();

    useEffect(() => {
        fetchUserStats().then(stats => {
            setUserStats(stats);
        })
    }, []);

    return (
        <BasePage>
            <Grid container spacing={3} alignItems="stretch">
                <Grid item md={2}>
                    <Grid container direction="column" alignItems="stretch" spacing={1}>
                        <Grid item>
                            <Card variant="outlined">
                                <CardContent>
                                    Hi, {loggedInUser.username}
                                </CardContent>
                            </Card>
                        </Grid>

                        <Grid item>
                            <Card variant="outlined">
                                <CardContent>
                                    <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom variant="h5">
                                        Cameras <Box component="span" sx={{fontWeight: 700}}>{userStats === null ? 'Loading' : userStats.cameraCount}</Box>
                                    </Typography>

                                    <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom variant="h5">
                                        Lenses <Box component="span" sx={{fontWeight: 700}}>{userStats === null ? 'Loading' : userStats.lensCount}</Box>
                                    </Typography>
                                </CardContent>
                            </Card>
                        </Grid>
                    </Grid>
                </Grid>

                <Grid item md={10}>
                    <Grid container direction="column">
                        <Grid item sx={{backgroundColor: 'pink'}}>
                            this is red color
                        </Grid>

                        <Grid item sx={{backgroundColor: 'cyan'}}>
                            this is blue color
                        </Grid>
                    </Grid>
                </Grid>
            </Grid>
        </BasePage>
    )
}
