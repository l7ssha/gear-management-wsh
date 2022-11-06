import * as React from "react";
import {Card, CardContent, Grid, Typography} from "@mui/material";;
import useApi from "../hooks/useApi";
import {UserStats} from "../hooks/useApi";
import {useEffect, useState} from "react";
import BasePage from "../components/base/BasePage";

export default function Root() {
    const {fetchUserStats} = useApi();
    const [userStats, setUserStats] = useState<UserStats|null>(null);

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
                                    <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom>
                                        Cameras
                                    </Typography>
                                    <Typography variant="h5">
                                        {userStats === null ? 'Loading' : userStats.cameraCount}
                                    </Typography>
                                    <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom>
                                        Lenses
                                    </Typography>
                                    <Typography variant="h5" component="span">
                                        {userStats === null ? 'Loading' : userStats.lensCount}
                                    </Typography>
                                </CardContent>
                            </Card>
                        </Grid>

                        <Grid item>
                            <Card variant="outlined">
                                <CardContent>
                                    this is blue color
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
