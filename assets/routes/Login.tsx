import * as React from "react";
import {useNavigate} from "react-router";
import {useState} from "react";
import AuthService from "../services/AuthService";
import {Alert, Button, Stack, TextField} from "@mui/material";

export default function Login() {
    const navigate = useNavigate();

    const [login, setLogin] = useState<string>();
    const [password, setPassword] = useState<string>();
    const [errorMessage, setErrorMessage] = useState<string>(null);

    const formSubmit = () => {
        AuthService.login(login, password).then(result => {
            if (result.successful) {
                navigate("/");
                return;
            }

            setErrorMessage(result.errorMessage);
        });
    }

    let errorMessageElement = errorMessage !== null
        ? <Alert severity="error">{errorMessage}</Alert>
        : undefined;

    return (
        <Stack spacing={2}>
            {errorMessageElement}
            <TextField id="outlined-basic" label="Login" variant="outlined" onChange={e => setLogin(e.target.value)}/>
            <TextField id="outlined-basic" label="Login" variant="outlined" type="password" onChange={e => setPassword(e.target.value)}/>
            <Button variant="outlined" type="submit" onClick={formSubmit}>Log in</Button>
        </Stack>
    )
}
