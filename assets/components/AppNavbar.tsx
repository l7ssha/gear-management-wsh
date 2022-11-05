import * as React from 'react';
import AppBar from '@mui/material/AppBar';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import CameraIcon from '@mui/icons-material/Camera';
import {Box, Button, Container, Grid} from "@mui/material";

function AppNavbar() {
    return (
        <AppBar position="static">
            <Toolbar>
                <Button
                    size="large"
                    color="inherit"
                >
                    <CameraIcon sx={{ mr: 2 }} />
                    <Typography sx={{fontWeight: 700}}>
                        Gear Manager
                    </Typography>
                </Button>

                <Button color="inherit" href="/cameras">
                    <Typography>
                        Cameras
                    </Typography>
                </Button>

                <Button color="inherit" href="/lenses">
                    <Typography>
                        Lenses
                    </Typography>
                </Button>

                <Button color="inherit" href="/film">
                    <Typography>
                        Film
                    </Typography>
                </Button>
            </Toolbar>
        </AppBar>
    );
}

export default AppNavbar;
