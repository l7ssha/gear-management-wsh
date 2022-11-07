import * as React from "react";
import {Box, Button, Card, CardActions, CardContent, CardHeader, Grid, Typography} from "@mui/material";
import useApi, {Camera} from "../hooks/useApi";
import {useEffect, useState} from "react";
import BasicLoader from "../components/loading/BasicLoader";
import {Link} from "react-router-dom";
import WrappedLink from "../components/navbar/WrappedLink";

export default function Root() {
    const {fetchCameras} = useApi();
    const [topCameras, setTopCameras] = useState<Camera[]|null>(null);
    const [topLenses, setTopLenses] = useState<any[]|null>([]);

    useEffect(() => {
        fetchCameras({
            "order[createdAt]": 'desc',
            perPage: "3"
        }).then(cameras => {
            setTopCameras(cameras.slice(0, 3));
        });
    }, []);

    const camerasList = topCameras?.length > 0
        ? topCameras.map(camera => <Box component='p' key={camera.id}><Link to={`/cameras/${camera.id}`}>{camera.producer.name} {camera.model} ({camera.serialNumber})</Link></Box>)
        : <Box component='span'>No cameras... :(</Box>
    ;

    const lensesList = topLenses !== null && topLenses.length > 0
        ? topLenses.map(lens => <Box component='p' key={lens.id}><Link to={`/lenses/${lens.id}`}>{lens.producer.name} {lens.model} ({lens.serialNumber})</Link></Box>)
        : <Box component='span'>No lenses... :(</Box>
    ;

    return (
        <Box component="div">
            <Grid container direction="column" spacing={1}>
                <Grid item>
                    <Card variant="outlined">
                        <CardContent>
                            <Grid container spacing={1}>
                                <Grid item md={6}>
                                    <Card variant="outlined">
                                        <CardHeader title='Latest Cameras' sx={{m: 0, p: 1}}/>
                                        <CardContent sx={{m: 0, p: 1}}>
                                            <BasicLoader loading={topCameras === null}>
                                                {camerasList}
                                            </BasicLoader>
                                        </CardContent>
                                        <CardActions>
                                            <WrappedLink to='/cameras'>
                                                <Button size="small">Browse cameras</Button>
                                            </WrappedLink>
                                        </CardActions>
                                    </Card>
                                </Grid>

                                <Grid item md={6}>
                                    <Card variant="outlined">
                                        <CardHeader title='Latest Lenses' sx={{m: 0, p: 1}}/>
                                        <CardContent sx={{m: 0, p: 1}}>
                                            <BasicLoader loading={topLenses === null}>
                                                {lensesList}
                                            </BasicLoader>
                                        </CardContent>
                                        <CardActions>
                                            <WrappedLink to='/lenses'>
                                                <Button size="small">Browse lenses</Button>
                                            </WrappedLink>
                                        </CardActions>
                                    </Card>
                                </Grid>
                            </Grid>
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
        </Box>
    )
}
