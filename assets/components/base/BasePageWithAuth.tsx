import * as React from "react";
import RequiresAuth from "./RequiresAuth";
import BasePage from "./BasePage";

export default function BasePageWithAuth(props: any) {
    return (
        <RequiresAuth>
            <BasePage>
                {props.children}
            </BasePage>
        </RequiresAuth>
    );
}
