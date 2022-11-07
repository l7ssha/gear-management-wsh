import * as React from "react";
import AppBar from "@mui/material/AppBar";
import Toolbar from "@mui/material/Toolbar";
import Typography from "@mui/material/Typography";
import { Avatar, Box, Divider, IconButton, Menu, MenuItem, Tooltip } from "@mui/material";
import useAuth from "../hooks/useAuth";
import NavbarLinkButton from "./navbar/NavbarLinkButton";
import LogoType from "./LogoType";
import WrappedLink from "./navbar/WrappedLink";

function AppNavbar() {
  const { loggedInUser, performLogOut } = useAuth();

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
        <Box sx={{ flexGrow: 1 }}>
          <WrappedLink to="/">
            <LogoType />
          </WrappedLink>

          <NavbarLinkButton text="Cameras" to="/cameras" />
          <NavbarLinkButton text="Lenses" to="/lenses" />
          <NavbarLinkButton text="Film" to="/film" />
        </Box>

        <Box sx={{ flexGrow: 0 }}>
          <Tooltip title="Open settings">
            <IconButton sx={{ p: 0 }} onClick={handleOpenUserMenu}>
              <Avatar alt={loggedInUser.username}>{loggedInUser.username.slice(0, 1).toUpperCase()}</Avatar>
            </IconButton>
          </Tooltip>

          <Menu
            sx={{ mt: "45px" }}
            id="menu-appbar"
            anchorEl={anchorElUser}
            anchorOrigin={{
              vertical: "top",
              horizontal: "right",
            }}
            keepMounted
            transformOrigin={{
              vertical: "top",
              horizontal: "right",
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
            <MenuItem onClick={performLogOut}>
              <Typography textAlign="center">Logout</Typography>
            </MenuItem>
          </Menu>
        </Box>
      </Toolbar>
    </AppBar>
  );
}

export default AppNavbar;
