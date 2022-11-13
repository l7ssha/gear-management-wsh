import * as React from "react";
import { useNavigate } from "react-router";
import { useState } from "react";
import AuthService from "../services/AuthService";
import { Alert, Button, Container, Stack, TextField } from "@mui/material";
import { useForm } from "react-hook-form";

interface FormSubmitData {
  login: string;
  password: string;
}

export default function Login() {
  const navigate = useNavigate();
  const { register, handleSubmit } = useForm();
  const [errorMessage, setErrorMessage] = useState<string>(null);

  const formSubmit = ({ login, password }: FormSubmitData) => {
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
      <form onSubmit={handleSubmit(formSubmit)}>
        <Stack spacing={2}>
          {errorMessageElement}
          <TextField
            label="Login"
            variant="outlined"
            {...register("login", { required: { value: true, message: "This field is required" }, min: 3 })}
          />
          <TextField
            label="Password"
            variant="outlined"
            type="password"
            {...register("password", { required: { value: true, message: "This field is required" }, min: 3 })}
          />
          <Button variant="outlined" type="submit">
            Log in
          </Button>
        </Stack>
      </form>
    </Container>
  );
}
