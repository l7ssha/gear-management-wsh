import AuthService from "../../services/AuthService";
import {useNavigate} from "react-router";
import {useEffect, useState} from "react";

export default function RequiresAuth(props: any) {
    const navigate = useNavigate();

    const [children, setChildren] = useState();

    useEffect(() => {
        if (!AuthService.isLoggedIn()) {
            navigate('/login');
        }

        setChildren(props.children);
    }, []);

    return (
        children
    );
}
