import * as React from "react";
import {Box, Card, CardContent, Grid, Link, Typography} from "@mui/material";;
import useApi, {Camera} from "../hooks/useApi";
import {UserStats} from "../hooks/useApi";
import {useEffect, useState} from "react";
import BasePage from "../components/base/BasePage";
import useAuth from "../hooks/useAuth";
import BasicLoader from "../components/loading/BasicLoader";

export default function Root() {
    const {fetchUserStats, fetchCameras} = useApi();
    const [userStats, setUserStats] = useState<UserStats|null>(null);
    const [topCamera, setTopCamera] = useState<Camera|null>(null);
    const {loggedInUser} = useAuth();

    useEffect(() => {
        fetchUserStats().then(stats => {
            setUserStats(stats);
        });

        fetchCameras({
            "order[createdAt]": 'desc',
            perPage: "1"
        }).then(cameras => {
            setTopCamera(cameras.pop());
        });
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
                                        <Box component="span">
                                            Cameras&nbsp;
                                        </Box>
                                        <Box component="span" sx={{fontWeight: 700}}>
                                            <BasicLoader loading={userStats === null} >
                                                <span>{userStats?.cameraCount}</span>
                                            </BasicLoader>
                                        </Box>
                                    </Typography>

                                    <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom variant="h5">
                                        <Box component="span">
                                            Lens&nbsp;
                                        </Box>
                                        <Box component="span" sx={{fontWeight: 700}}>
                                            <BasicLoader loading={userStats === null}>
                                                <span>{userStats?.lensCount}</span>
                                            </BasicLoader>
                                        </Box>
                                    </Typography>
                                </CardContent>
                            </Card>
                        </Grid>
                    </Grid>
                </Grid>

                <Grid item md={10}>
                    <Grid container direction="column" spacing={1}>
                        <Grid item>
                            <Card variant="outlined">
                                <CardContent>
                                    <Typography component='p' variant='h5'>
                                        Latest Camera
                                    </Typography>
                                    <BasicLoader loading={topCamera === null}>
                                        <Link href={`/camera/${topCamera?.id}`}>{topCamera?.producer.name} {topCamera?.model} ({topCamera?.serialNumber})</Link>
                                    </BasicLoader>

                                    <Typography component='p' variant='h5'>
                                        Latest Lens
                                    </Typography>
                                    <Box>
                                        TODO
                                    </Box>
                                </CardContent>
                            </Card>
                        </Grid>

                        <Grid item>
                            <Card variant="outlined">
                                <CardContent>
                                    This is next card
                                </CardContent>
                            </Card>
                        </Grid>
                    </Grid>
                </Grid>
            </Grid>
        </BasePage>
    )
}
