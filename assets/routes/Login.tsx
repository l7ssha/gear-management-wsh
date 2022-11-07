import * as React from "react";
import { useNavigate } from "react-router";
import { useState } from "react";
import AuthService from "../services/AuthService";
import { Alert, Button, Container, Stack, TextField } from "@mui/material";

export default function Login() {
  const navigate = useNavigate();

  const [login, setLogin] = useState<string>();
  const [password, setPassword] = useState<string>();
  const [errorMessage, setErrorMessage] = useState<string>(null);

  const formSubmit = (e: any) => {
    e.preventDefault();

    AuthService.login(login, password).then((result) => {
      if (result.successful) {
        navigate("/");
        return;
      }

      setErrorMessage(result.errorMessage);
    });
  };

  let errorMessageElement = errorMessage !== null ? <Alert severity="error">{errorMessage}</Alert> : undefined;

  return (
    <Container sx={{ mt: 10, paddingBottom: 2 }}>
      <form onSubmit={formSubmit}>
        <Stack spacing={2}>
          {errorMessageElement}
          <TextField id="outlined-basic" label="Login" variant="outlined" onChange={(e) => setLogin(e.target.value)} />
          <TextField
            id="outlined-basic"
            label="Password"
            variant="outlined"
            type="password"
            onChange={(e) => setPassword(e.target.value)}
          />
          <Button variant="outlined" type="submit">
            Log in
          </Button>
        </Stack>
      </form>
    </Container>
  );
}
