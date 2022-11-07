import {Link} from "react-router-dom";
import * as React from "react";
import {PropsWithChildren} from "react";

export interface WrappedLinkProps extends PropsWithChildren {
    to: string
}

export default function WrappedLink({to, children}: WrappedLinkProps) {
    return (
        <Link to={to}>
            {children}
        </Link>
    )
}
