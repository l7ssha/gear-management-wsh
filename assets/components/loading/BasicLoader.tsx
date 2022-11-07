import * as React from "react";
import Loader from "./Loader";
import { PropsWithChildren } from "react";
import { Box } from "@mui/material";

interface BasicLoaderProps extends PropsWithChildren {
  loading: boolean;
}

export default function BasicLoader({ loading, children }: BasicLoaderProps) {
  const loadingElement = <Box component="span">Loading...</Box>;

  return <Loader loading={loading} loadingElement={loadingElement} children={children} />;
}
