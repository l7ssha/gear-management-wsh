import { createRoot } from "react-dom/client";
import * as React from "react";
import { createBrowserRouter, RouterProvider } from "react-router-dom";

import Root from "./routes/Root";
import AdminUsers from "./routes/AdminUsers";
import Login from "./routes/Login";
import Cameras from "./routes/camera/Cameras";
import CameraDetails from "./routes/camera/CameraDetails";

import "@fontsource/roboto/300.css";
import "@fontsource/roboto/400.css";
import "@fontsource/roboto/500.css";
import "@fontsource/roboto/700.css";
import { routerIdParamLoader } from "./utils/routerIdParamLoader";
import BasePageAuthenticatedWithLayout from "./components/base/BasePageAuthenticatedWithLayout";

const router = createBrowserRouter([
  {
    path: "/",
    element: <BasePageAuthenticatedWithLayout />,
    children: [
      {
        index: true,
        element: <Root />,
      },
      {
        path: "/cameras/:id",
        element: <CameraDetails />,
        loader: routerIdParamLoader,
      },
      {
        path: "/cameras",
        element: <Cameras />,
      },
      {
        path: "/admin/users",
        element: <AdminUsers />,
      },
    ],
  },
  {
    path: "/login",
    element: <Login />,
  },
]);

createRoot(document.getElementById("root")).render(
  // <React.StrictMode>
  <RouterProvider router={router} />
  // </React.StrictMode>
);
