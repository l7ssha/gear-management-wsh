import {createRoot} from "react-dom/client";
import * as React from "react";
import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";

import Root from "./routes/Root";
import AdminUsers from "./routes/AdminUsers";
import Login from "./routes/Login";

const router = createBrowserRouter([
    {
        path: "/",
        element: <Root />
    },
    {
        path: "/login",
        element: <Login />
    },
    {
        path: "/admin/users",
        element: <AdminUsers />
    }
]);

createRoot(document.getElementById("root")).render(
    <React.StrictMode>
        <RouterProvider router={router} />
    </React.StrictMode>
);
