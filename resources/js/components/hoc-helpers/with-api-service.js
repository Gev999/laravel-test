import React from 'react'
import {ApiServiceConsumer} from '../api-service-context';
 
const withApiService = (Wrap)=> {
    return (props)=> {
        return (
        <ApiServiceConsumer>
            {(apiService)=>{

                return <Wrap {...props} apiService = {apiService} />
            }}
        </ApiServiceConsumer>
        );
    }
}

export default withApiService