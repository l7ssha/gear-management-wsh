import * as React from "react";
import {Container, Grid, Stack} from "@mui/material";
import BasePageWithAuth from "../components/base/BasePageWithAuth";

export default function Root() {
    return (
        <BasePageWithAuth>
            <Grid container spacing={3} alignItems="stretch">
                <Grid item md={2}>
                    <Grid container direction="column" alignItems="stretch">
                        <Grid item sx={{backgroundColor: 'red'}}>
                            this is red color
                        </Grid>

                        <Grid item sx={{backgroundColor: 'blue'}}>
                            this is blue color
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
        </BasePageWithAuth>
    )
}
