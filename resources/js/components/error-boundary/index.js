import React from 'react'

const ErrorBoundary = (props)=>{
    return (
        <center>
            <h1 className="mt-5">{ props.error }</h1>
        </center>
    )
}

export default ErrorBoundary;