import {Container, Grid} from "@mui/material";
import AppNavbar from "../AppNavbar";
import * as React from "react";
import RequiresAuth from "./RequiresAuth";

export default function BasePageWithAuth(props: any) {
    return (
        <RequiresAuth>
            <AppNavbar />
            <Container sx={{mt: 10, backgroundColor: 'green', paddingBottom: 2}}>
                {props.children}
            </Container>
        </RequiresAuth>
    );
}
