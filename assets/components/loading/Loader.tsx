import {ComponentProps, JSXElementConstructor, PropsWithChildren, ReactElement, ReactFragment, ReactNode} from "react";
import {Box} from "@mui/material";
import * as React from "react";

export interface LoaderProps extends PropsWithChildren {
    loading: boolean,
    loadingElement: any
}

export default function Loader({loading, loadingElement, children}: LoaderProps) {
    if (loading) {
        return loadingElement;
    }

    return children;
}
