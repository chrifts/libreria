import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import AsyncStorage from '@callstack/async-storage';
import { Document, Page } from 'react-pdf';
import axios from 'axios';
import sha256 from 'crypto-js/sha256';
import hmacSHA512 from 'crypto-js/hmac-sha512';
import Base64 from 'crypto-js/enc-base64';
var CryptoJS = require("crypto-js");

async function makePostRequest() {

    let res = await axios.post('/pdf/4');
    setB64(res)

}

const Example = () => {
    const [ isLoading, setIsLoading ] = useState(false)
    const [ data, setData ] = useState([])

   useEffect(() => {
     async function fetchData() {
       setIsLoading(true)
       const response = await axios.post('/pdf/3');


       setData(response.data.name)
       setIsLoading(false)
     }
     fetchData()
    }, [])
    //console.log(data.name)
    return isLoading ? <div>Loading</div> : <Document file={`data:application/pdf;base64,${data}`}></Document>
  }

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
