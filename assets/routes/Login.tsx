import * as React from "react";
import {useNavigate} from "react-router";
import {useState} from "react";
import AuthService from "../services/AuthService";

export default function Login() {
    const navigate = useNavigate();

    const [login, setLogin] = useState<string>();
    const [password, setPassword] = useState<string>();
    const [errorMessage, setErrorMessage] = useState<string>();

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
        ? <span style={{color: 'red'}}>{errorMessage}</span>
        : undefined;

    return (
        <div>
            {errorMessageElement}
            <input type="text" placeholder="Login" onChange={e => setLogin(e.target.value)} />
            <input type="password" placeholder="password" onChange={e => setPassword(e.target.value)}/>
            <button type="submit" onClick={formSubmit}>Log in</button>
        </div>
    )
}
