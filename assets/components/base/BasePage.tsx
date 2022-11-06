import {Container, Grid} from "@mui/material";
import AppNavbar from "../AppNavbar";
import * as React from "react";

export default function BasePage(props: any) {
    return (
        <Container>
            <AppNavbar />
            <Container sx={{mt: 10, backgroundColor: 'green', paddingBottom: 2}}>
                {props.children}
            </Container>
        </Container>
    );
}
