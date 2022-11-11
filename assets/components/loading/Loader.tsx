import { PropsWithChildren } from "react";
import * as React from "react";

export interface LoaderProps extends PropsWithChildren {
  loading: boolean;
  loadingElement: any;
}

export default function Loader({ loading, loadingElement, children }: LoaderProps) {
  if (loading) {
    return loadingElement;
  }

  return children;
}
