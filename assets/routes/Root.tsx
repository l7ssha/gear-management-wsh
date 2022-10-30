import * as React from "react";
import AuthService from "../services/AuthService";
import {useNavigate} from "react-router";

export default function Root() {
    const navigate = useNavigate();

    AuthService.checkIfLoggedIn().then(loggedIn => {
        console.log(loggedIn);
        if (!loggedIn) {
            navigate('/login');
        }
    })

    return (
        <div>
            Root works
        </div>
    )
}
