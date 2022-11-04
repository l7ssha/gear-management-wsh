import * as React from "react";
import {useNavigate} from "react-router";
import AppNavbar from "../components/AppNavbar";

export default function Root() {
    const navigate = useNavigate();

    return (
        <div>
            <AppNavbar />
            Root works
        </div>
    )
}
