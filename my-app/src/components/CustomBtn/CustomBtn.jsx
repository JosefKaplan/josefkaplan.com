import React from 'react'
import { Button } from '@material-ui/core' //imports button from ui-core
import { withStyles } from '@material-ui/core/styles' //imports hooks for using css inside react component

const StyledButton = withStyles({
    root: {
        display: "flex",
        alignItems: "center",
        justifyContent: "center",
        height: "44px",
        padding: "0 25px",
        boxSizing: "border-box",
        borderRaadius: 0,
        background: "#4f25f7",
        color: "#fff",
        transform: "none",
        boxShadow: "6px 6px 0 0 #c7d8ed",
        transition: "background .3s,border-color .3s,color .3s",
        "&hover": {
            background: "#4f25f7"
        },
    },
    label: {
        textTransfrom: 'capitalize',
    },
})(Button);

export default function CustomBtn(props) {
    return (
            <StyledButton variant="contained">
                {props.txt}
            </StyledButton>
    )
}
