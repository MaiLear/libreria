
const request = async(url,options = {})=>{
    console.log(url);
    try{
        let response = await fetch(url,options);
        let json = await response.json();
        if(!response.ok) {
            throw{errors:json.errors,message:json.message,response,error:true}
        }
        return json;
    }catch(error){
        console.error(error);
        return error;
    }
}

export{
    request
}