import * as React from "react";
import WrappedLink from "./WrappedLink";
import { Button, Typography } from "@mui/material";

interface NavbarLinkButtonProps {
  to: string;
  text: string;
}

export default function NavbarLinkButton({ to, text }: NavbarLinkButtonProps) {
  return (
    <WrappedLink to={to}>
      <Button sx={{ color: "white" }}>
        <Typography>{text}</Typography>
      </Button>
    </WrappedLink>
  );
}
