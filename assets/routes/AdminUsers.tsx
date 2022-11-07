import * as React from "react";
import {useEffect, useState} from "react";
import useAxiosWithAuth from "../hooks/useAxiosWithAuth";
import BasePageAuthenticatedWithLayout from "../components/base/BasePageAuthenticatedWithLayout";
import {Box} from "@mui/material";

interface User {
    id: string,
    email: string,
    username: string
}

export default function AdminUsers() {
    const axiosWithAuth = useAxiosWithAuth();
    const [users, setUsers] = useState<User[]>([])

    useEffect(() => {
        axiosWithAuth.get<User[]>("/api/users").then(response => {
            setUsers(response.data);
        });
    }, []);

    return (
        <Box component="div">
            <span>Users</span>
            {
                users.map((user) => {
                    return <p key={user.id}>{user.username} {user.email}</p>
                })
            }
        </Box>
    )
}
