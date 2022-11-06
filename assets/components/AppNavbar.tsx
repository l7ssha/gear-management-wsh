import * as React from 'react';
import AppBar from '@mui/material/AppBar';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import CameraIcon from '@mui/icons-material/Camera';
import {Avatar, Box, Button, Container, Divider, Grid, IconButton, Menu, MenuItem, Tooltip} from "@mui/material";
import useAuth from "../hooks/useAuth";

function AppNavbar() {
    const {loggedInUser, logOut} = useAuth();
    const loggedInUserStorage = loggedInUser();

    const [anchorElUser, setAnchorElUser] = React.useState<null | HTMLElement>(null);
    const handleCloseUserMenu = () => {
        setAnchorElUser(null);
    };

    const handleOpenUserMenu = (event: React.MouseEvent<HTMLElement>) => {
        setAnchorElUser(event.currentTarget);
    };

    return (
        <AppBar>
            <Toolbar>
                <Box sx={{flexGrow: 1}}>
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
                </Box>

                <Box sx={{flexGrow: 0}}>
                    <Tooltip title="Open settings">
                        <IconButton sx={{ p: 0 }} onClick={handleOpenUserMenu}>
                            <Avatar alt={loggedInUserStorage.username}>{loggedInUserStorage.username.slice(0, 1).toUpperCase()}</Avatar>
                        </IconButton>
                    </Tooltip>

                    <Menu
                        sx={{ mt: '45px' }}
                        id="menu-appbar"
                        anchorEl={anchorElUser}
                        anchorOrigin={{
                            vertical: 'top',
                            horizontal: 'right',
                        }}
                        keepMounted
                        transformOrigin={{
                            vertical: 'top',
                            horizontal: 'right',
                        }}
                        open={Boolean(anchorElUser)}
                        onClose={handleCloseUserMenu}
                    >
                        <MenuItem onClick={handleCloseUserMenu}>
                            <Typography textAlign="center">Profile</Typography>
                        </MenuItem>

                        <MenuItem onClick={handleCloseUserMenu}>
                            <Typography textAlign="center">Preferences</Typography>
                        </MenuItem>

                        <MenuItem onClick={handleCloseUserMenu}>
                            <Typography textAlign="center">Settings</Typography>
                        </MenuItem>
                        <Divider />
                        <MenuItem onClick={() => logOut()}>
                            <Typography textAlign="center">Logout</Typography>
                        </MenuItem>
                    </Menu>
                </Box>
            </Toolbar>
        </AppBar>
    );
}

export default AppNavbar;
